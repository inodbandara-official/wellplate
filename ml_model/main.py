import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.linear_model import LogisticRegression
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
import random
from sklearn.metrics import accuracy_score
import joblib

df_food = pd.read_csv("C:\\Users\\Kamal\\PycharmProjects\\1 programme\\pred_food.csv")
df_food['Glycemic Index'] = pd.to_numeric(df_food['Glycemic Index'], errors='coerce')
df_food['Glycemic Index Category'] = pd.cut(df_food['Glycemic Index'], bins=[-float('inf'), 55, 69, float('inf')],
                                            labels=['Below 55', '55 to 69', 'Above 69'])

# Feature extraction
tfidf = TfidfVectorizer()
food_names_matrix = tfidf.fit_transform(df_food['Food Name'])
encoder = LabelEncoder()
y = encoder.fit_transform(df_food['Glycemic Index Category'])

# training and testing sets
X_train, X_test, y_train, y_test = train_test_split(food_names_matrix, y, test_size=0.3, random_state=42)

# Logistic Regression model with 200 iterations using 'lbfgs' solver
model = LogisticRegression(max_iter=200)
model.fit(X_train, y_train)

y_pred = model.predict(X_test)
accuracy = accuracy_score(y_test, y_pred)
#print(f"Model accuracy: {accuracy * 100:.2f}%")
#print(f"Number of iterations: {model.n_iter_[0]}")

food_name_variations = {
    'carrots': 'carrot',
    'tomatos': 'tomato',
}

def map_blood_sugar_to_glycemic_index(blood_sugar_level):
    if blood_sugar_level < 70:
        glycemic_index = 85
    elif 70 <= blood_sugar_level <= 100:
        glycemic_index = None
    elif 100 < blood_sugar_level <= 125:
        glycemic_index = 62
    else:
        glycemic_index = 26
    return glycemic_index

def get_recommendations(allergies=None, is_vegetarian=False, blood_sugar_level=None, cheat_day=False):
    if blood_sugar_level is None:
        return "Blood sugar level is required."

    try:
        blood_sugar_level = float(blood_sugar_level)  # Convert to float
    except ValueError:
        return f"Invalid blood sugar level value: {blood_sugar_level}"

    glycemic_index = map_blood_sugar_to_glycemic_index(blood_sugar_level)

    if glycemic_index is None:
        user_food_preference = 'Any'
    else:
        glycemic_index_category = pd.cut([glycemic_index], bins=[-float('inf'), 55, 69, float('inf')],
                                         labels=['Below 55', '55 to 69', 'Above 69'])[0]
        user_food_preference = f"{glycemic_index_category} {' (Vege)' if is_vegetarian else ''}"

    # Use the trained model to predict glycemic index category
    user_input = tfidf.transform([user_food_preference])
    predicted_category = encoder.inverse_transform(model.predict(user_input))[0]

    # Get recommended food names based on the predicted category and dietary preference
    if is_vegetarian:
        recommended_food_names = df_food[(df_food['Glycemic Index Category'] == predicted_category) & (df_food['Type'] == 'vege')]['Food Name'].tolist()
    else:
        recommended_food_names = df_food[df_food['Glycemic Index Category'] == predicted_category]['Food Name'].tolist()

    # remove allergies
    if allergies:
        allergies = [allergy.strip().lower() for allergy in allergies.split(',')]
        allergies = [food_name_variations.get(allergy, allergy) for allergy in allergies]
        recommended_food_names = [food_name for food_name in recommended_food_names if food_name_variations.get(food_name.lower(), food_name.lower()) not in allergies]

    days_of_week = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
    meal_recommendations = {}

    recommendations = []
    for day in days_of_week:
        if cheat_day and day == 'Saturday':
            recommendations.append(f"{day}:")
            recommendations.append("  Enjoy Your Cheat Day!")
            recommendations.append("")
            meal_recommendations[day] = "Cheat Day"
            continue

        random.shuffle(recommended_food_names)
        breakfast_recommendations = recommended_food_names[:3]
        del recommended_food_names[:3]

        if not recommended_food_names:
            if is_vegetarian:
                recommended_food_names = df_food['Food Name'][df_food['Type'] == 'vege'].tolist()
            else:
                recommended_food_names = df_food['Food Name'].tolist()
            recommended_food_names = [food_name for food_name in recommended_food_names if food_name_variations.get(food_name.lower(), food_name.lower()) not in allergies]

        random.shuffle(recommended_food_names)
        lunch_recommendations = recommended_food_names[:3]
        del recommended_food_names[:3]

        if not recommended_food_names:
            if is_vegetarian:
                recommended_food_names = df_food['Food Name'][df_food['Type'] == 'vege'].tolist()
            else:
                recommended_food_names = df_food['Food Name'].tolist()
            recommended_food_names = [food_name for food_name in recommended_food_names if food_name_variations.get(food_name.lower(), food_name.lower()) not in allergies]

        random.shuffle(recommended_food_names)
        dinner_recommendations = recommended_food_names[:3]
        del recommended_food_names[:3]

        meal_recommendations[day] = {
            'Breakfast': breakfast_recommendations,
            'Lunch': lunch_recommendations,
            'Dinner': dinner_recommendations
        }

        if not cheat_day or day != 'Saturday':
            recommendations.append(f"{day}:")
            recommendations.append("")
            for meal, food_names in meal_recommendations[day].items():
                recommendations.append(f"  {meal}:")
                for food_name in food_names:
                    recommendations.append(f"    {food_name}")
                recommendations.append("")
            recommendations.append("")

    recommendations = '\n'.join(recommendations)
    return recommendations

# Save the model to a file
joblib.dump(model, 'logistic_regression_model.joblib')
