import numpy as np
import pandas as pd
import json
import pymysql
import csv
import matplotlib.pyplot as plt
import time


# Connect to MySQL

conn = pymysql.connect(host="localhost",

                       user="root",

                       password='',

                       database="data-copy")

# Create a cursor
cur = conn.cursor()

 #Get the data from the table

cur.execute("SELECT * FROM `data-copy`")

# Get the results as a list of tuples

results = cur.fetchall()
# Close the cursor

cur.close()

# Open a CSV file for writing

with open('my_data.csv', 'w') as csvfile:

  # Create a CSV writer object

  writer = csv.writer(csvfile)

  # Write the header row
  writer.writerow(['ID', 'date', 'time', 'temperature', 'humidity'])

  # Write the data rows
  for row in results:
    writer.writerow(row)

# Close the CSV file

csvfile.close()
df = pd.read_csv("my_data.csv")
print(df)
# Extract the "Temperature" column
Temp_column = df['temperature']

# Create a new column for the results
df['temp(depend)'] = None

# Iterate over the rows of the DataFrame
for index, row in df.iterrows():
  df.loc[index, 'temp(depend)']= 1 + row['temperature']

# Print the DataFrame
print(df)
# Extract the "Humidity" column
Humidity_column = df['humidity']

# Create a new column for the results
df['Hum(depend)'] = None

# Iterate over the rows of the DataFrame
for index, row in df.iterrows():
  df.loc[index, 'Hum(depend)']= 1 + row['humidity']

# Print the DataFrame
print(df)
df.head()
# view dimensions of dataset

df.shape
#View summary of dataset

df.info()
df.describe()
# Extract the "Temperature" column
Temp_column = df['temp(depend)']
# Extract the "Hum(depend)" column
Hum_column = df['Hum(depend)']

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
  if 12<=row['temp(depend)'] <=35:
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
  if 70<=row['Hum(depend)'] <=80:
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
json_data = df.to_json(orient='records')

#write json data in file
file_path = 'output.json'

with open(file_path, 'w') as json_file:
    json_file.write(json_data)

import matplotlib.pyplot as plt
import seaborn as sns

# Calculate the correlation coefficient
correlation = df['humidity'].corr(df['temperature'])

# Create a scatter plot of the two columns
sns.scatterplot(x=df['humidity'], y= df['temperature'], data=df)

# Add a line of best fit to the scatter plot
sns.regplot(x=df['humidity'], y=df['temperature'], data=df)

# Add a label to the axis
plt.xlabel(df['humidity'])
plt.ylabel(df['temperature'])

# Add a title to the plot
plt.title('Correlation between Humidity and Temperature')

# Show the plot
plt.show()