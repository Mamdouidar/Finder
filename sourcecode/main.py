import json
from re import L
import cv2;
import face_recognition;

#def matchImages():
img = cv2.imread("P:/finder/sourcecode/Messi1.webp");
rgb_img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB);
img_encoding = face_recognition.face_encodings(rgb_img)[0];

    #img2 = cv2.imread("../images/Elon Musk.jpg");
#img2 = cv2.imread("Messi1.webp");
img2 = cv2.imread("P:/finder/public/storage/images/nZ_VjLY7_400x400.jpg");
rgb_img2 = cv2.cvtColor(img2, cv2.COLOR_BGR2RGB);
img_encoding2 = face_recognition.face_encodings(rgb_img2)[0];

result = face_recognition.compare_faces([img_encoding], img_encoding2);
#print("Result:", result);
print(True in result);
    #return result;

#matchImages();

#cv2.imshow("Img", img);
#cv2.imshow("Img 2", img2);
#cv2.waitKey(0);
