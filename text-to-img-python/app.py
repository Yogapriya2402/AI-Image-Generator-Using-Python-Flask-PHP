from flask import Flask, jsonify,request
import requests, json

app = Flask(__name__)

API_KEY = 'key-3DEMEbktEizYlF0MMSCTi948924rUc9eiicxckxX190ByNwXWgVaQOHBYuEzcOI4arYcFGZf8cp8H0TP5qWbamkDD4hYtPHY'

@app.route('/generate', methods = ['POST']) 
def ReturnJSON(): 
    if request.method == 'POST':
        url = 'https://api.getimg.ai/v1/stable-diffusion/text-to-image'
        headers = {
             "accept": "application/json",
             "Content-Type": "application/json",
             "Authorization": "Bearer "+API_KEY
        }
 
        prompt = {
            'model': 'stable-diffusion-v1-5',
            'prompt': str(request.json['input']),
            'width': 512,
            'height': 512,
            'steps': 25,
            'guidance': 7.5,
            'seed': 0,
            'scheduler': 'dpmsolver++',
            'output_format': 'jpeg'
        }
        
        api_call = requests.post(url,data=json.dumps(prompt),headers=headers)
        return jsonify(api_call.json()) 

if __name__ == "__main__":
    app.run(debug=True)