import os

# Set an environment variable
os.environ['MY_NAME'] = 'Alice kaka'

# Access the environment variable
my_name = os.environ.get('MY_NAME')
print(my_name)  # Output: Alice
