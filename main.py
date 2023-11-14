import numpy as np
import pandas as pd
import json

df = pd.read_csv("111.csv")
print(df)
# Extract the "Temperature" column
Temp_column = df['Temp']

# Create a new column for the results
df['temp(depend)'] = None

# Iterate over the rows of the DataFrame
for index, row in df.iterrows():
  df.loc[index, 'temp(depend)']= 1+row['Temp']

# Print the DataFrame
print(df)
# Extract the "Humidity" column
Humidity_column = df['Humidity']

# Create a new column for the results
df['Hum(depend)'] = None

# Iterate over the rows of the DataFrame
for index, row in df.iterrows():
  df.loc[index, 'Hum(depend)']= 1+row['Humidity']

# Print the DataFrame
print(df)
df.head()
# view dimensions of dataset

df.shape
#View summary of dataset

df.info()
df.describe()
import seaborn as sns
sns.scatterplot(x="Hum(depend)", y="temp(depend)", data=df);
#Seperate independent and dependent variable
x= df.iloc[:, -2].values
y= df.iloc[:, -1].values
print(x)
print(y)

from sklearn.impute import SimpleImputer

# Reshape the array to two dimensions
x = x.reshape(-1, 1)

# Fit the imputer
imputer = SimpleImputer(missing_values=np.nan, strategy='most_frequent')
imputer.fit(x)

# Transform the array
x = imputer.transform(x)

# Reshape the array back to one dimension
x = x.flatten()
print(x)

from sklearn.impute import SimpleImputer

# Reshape the array to two dimensions
y = y.reshape(-1, 1)

# Fit the imputer
imputer = SimpleImputer(missing_values=np.nan, strategy='most_frequent')
imputer.fit(y)

# Transform the array
y = imputer.transform(y)

# Reshape the array back to one dimension
y = y.flatten()
print(y)
# Extract the "Temperature" column
Temp_column = df['temp(depend)']

# Create a new column for the results
df['depend1'] = None

# Iterate over the rows of the DataFrame
for index, row in df.iterrows():

  #check the condition
  if 28<=row['temp(depend)'] <=30:
    #assign a value to the new column if the condition is met
    df.loc[index, 'depend1'] = True
  else:
    #assign another value to the new column if the condition is not met
    df.loc[index, 'depend1'] = False

#print the Dataframe
print(df)
# Extract the "Hum(depend)" column
Temp_column = df['Hum(depend)']

# Create a new column for the results
df['depend2'] = None

# Iterate over the rows of the DataFrame
for index, row in df.iterrows():

  #check the condition
  if 80<=row['Hum(depend)'] <=85:
    #assign a value to the new column if the condition is met
    df.loc[index, 'depend2'] = True
  else:
    #assign another value to the new column if the condition is not met
    df.loc[index, 'depend2'] = False

#print the Dataframe
print(df)
# Extract the "depend1" column
Temp_column = df['depend1']
# Extract the "depend2" column
Hum_column = df['depend2']

# Create a new column for the results
df['Result'] = None

# Iterate over the rows of the DataFrame
for index, row in df.iterrows():

  #check the condition
  if row['depend1']== row['depend2']:
    #assign a value to the new column if the condition is met
    df.loc[index, 'Result'] = True
  else:
    #assign another value to the new column if the condition is not met
    df.loc[index, 'Result'] = False

#print the Dataframe
print(df)
#convert the dataframe to JSON format
json_data= df.to_json(orient='records')