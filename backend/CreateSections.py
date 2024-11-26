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
        df = pd.read_excel(file_path, header=None)

        # Extract metadata (first row)
        metadata = {
            "Course": df.iloc[1, 0],
            "Section Name": df.iloc[1, 1],
            "Teacher's Name": df.iloc[1, 2]
        }

        # Extract students (from the 3rd row onward, assuming full names are in the first column)
        students = df.iloc[4:, 0].dropna().tolist()

        # Combine metadata and students into a structured JSON
        result = {
            "metadata": metadata,
            "students": students
        }

        return json.dumps(result, indent=4)

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
