import speech_recognition as sr
import webbrowser
import pyttsx3
import musiclibrary
import requests
from gtts import gTTS   
import pygame
import os
from openai import OpenAI

#pip install pocket
recognizer = sr.Recognizer()
engine = pyttsx3.init()
newsapi = "f55c7aa76b0c4b80b20f5751301a7d46"

def speak_old(text):
    engine.say(text)
    engine.runAndWait()

def aiprocess(command):
    client = OpenAI(
    base_url="https://openrouter.ai/api/v1",
    api_key="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")

    completion = client.chat.completions.create(
    model="openai/gpt-3.5-turbo",  # Note: prefix with `openai/`
    messages=[
        {"role": "system", "content": "You are a virtual assistant named Jarvis skilled in general tasks like Alexa and Google cloud. Give short responses please"},
        {"role": "user", "content": command}
    ]
    )

    return completion.choices[0].message.content




def speak(text):
    tts=gTTS(text)
    tts.save("temp.mp3")
    
    pygame.mixer.init()
    pygame.mixer.music.load("temp.mp3")
    pygame.mixer.music.play()
    while pygame.mixer.music.get_busy():
        pygame.time.Clock().tick(10)

    pygame.mixer.music.unload()
    os.remove("temp.mp3")

def processcommand(c):
    if "open google" in c.lower():
        webbrowser.open("https://google.com")
    elif "open youtube" in c.lower():
        webbrowser.open("https://youtube.com")
    elif "open linkedin" in c.lower():
        webbrowser.open("https://linkedin.com")
    elif "open facebook" in c.lower():
        webbrowser.open("https://facebook.com")
    elif c.lower().startswith("play"):
        song = c.lower().split(" ")[1]
        link = musiclibrary.music[song]
        webbrowser.open(link)

    elif "news" in c.lower():
        r=requests.get(f"https://newsapi.org/v2/top-headlines?country=us&apiKey={newsapi}")
        if r.status_code == 200:
            data = r.json()
            # Extract and print the headlines
            articles = data.get('articles', [])
            
            for article in articles:
                speak(article['title'])
    else:
        #let open ai handle the request
        output =aiprocess(c)
        speak(output)


if __name__=="__main__":
    speak("initalizing Jarvis.....")
    while True:
    #listen for the wake word "jarvis"
    #obtain audio from the microphone
        r = sr.Recognizer()
        

        # recognize speech using Sphinx
        print("recognizing....")
        try:
            with sr.Microphone() as source:
                print("Listening....")
                audio = r.listen(source, timeout=2, phrase_time_limit=1)
            word= r.recognize_google(audio)
            if(word.lower()=="jarvis"):
                speak("Ya") 
                #listen for command
                with sr.Microphone() as source:
                    print("Jarvis Active....")
                    audio = r.listen(source)
                    command = r.recognize_google(audio)

                    processcommand(command)



        except sr.UnknownValueError:
            print("Sphinx could not understand audio")
        except Exception as e:
            print("Error; {0}".format(e))
