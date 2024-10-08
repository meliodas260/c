import pandas as pd
import json
import os
import sys

def read_excel(file_path):
    try:
        # Check if the file exists
        if not os.path.exists(file_path):
            return json.dumps({"error": "File does not exist."})

        # Read the Excel file
        df = pd.read_excel(file_path)
        # Convert DataFrame to a dictionary and return as JSON
        return df.to_json(orient='records')
    except Exception as e:
        return json.dumps({"error": str(e)})

if __name__ == "__main__":

    # Get the file path from command-line arguments
    file_path = sys.argv[1] if len(sys.argv) > 1 else None

    if file_path:
        # Read the Excel file and print the contents
        output = read_excel(file_path)
        print(output)  # This will print JSON output
    else:
        print(json.dumps({"error": "No file path provided."}))
