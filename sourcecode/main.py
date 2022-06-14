import json
from re import L
import cv2;
import face_recognition;
import glob;
import os;
import numpy as np;

files = glob.glob("P:/finder/public/storage/pictures/*");
pictures = np.empty(len(files));
processed_pictures = [];

files2 = glob.glob("P:/finder/public/storage/images/*");
images = np.empty(len(files2));
latest_file = max(files2, key=os.path.getctime);

for i in files:

#def matchImages():
    img = cv2.imread(i);
    rgb_img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB);
    img_encoding = face_recognition.face_encodings(rgb_img)[0];
    processed_pictures.append(img_encoding);

    #img2 = cv2.imread("../images/Elon Musk.jpg");
#img2 = cv2.imread("Messi1.webp");

img2 = cv2.imread(latest_file);
rgb_img2 = cv2.cvtColor(img2, cv2.COLOR_BGR2RGB);
img_encoding2 = face_recognition.face_encodings(rgb_img2)[0];

result = face_recognition.compare_faces(processed_pictures, img_encoding2);
#print("Result:", result);
print(True in result);


    #return result;

#matchImages();

#cv2.imshow("Img", img);
#cv2.imshow("Img 2", img2);
#cv2.waitKey(0);
