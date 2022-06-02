import requests;

def getReportedImages():
    response = requests.get('http://127.0.0.1:8000/api/reports');
    #print(response.status_code);
    #print(response.json());

    #images = response.json()['data'][0]['attributes']['picture_url'];
    data = response.json()['data'];

    for entry in data:
        images = entry['attributes']['picture_url'];
        print(images);

def getImages():
    response = requests.get('http://127.0.0.1:8000/api/ai');

    data = response.json()['data'][0]['data']['image_url'];
    return data;

#getReportedImages();
#data = getImages();


