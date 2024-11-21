# Importar bibliotecas necesarias
import nltk
import spacy
from textblob import TextBlob
from transformers import pipeline
from gensim.models import Word2Vec

# Descargar recursos necesarios para NLTK
nltk.download('punkt')

# ----------------- NLTK - Tokenización -----------------
from nltk.tokenize import word_tokenize

def nlp_nltk(text):
    words = word_tokenize(text)
    print("NLTK - Tokenización:")
    print(words)
    print()

# ----------------- spaCy - Lematización -----------------
nlp_spacy = spacy.load('es_core_news_sm')  # Cargar el modelo en español

def nlp_spacy(text):
    doc = nlp_spacy(text)
    print("spaCy - Lematización y Dependencias:")
    for token in doc:
        print(f"Palabra: {token.text}, Lematización: {token.lemma_}, Dependencia: {token.dep_}")
    print()

# ----------------- TextBlob - Análisis de Sentimientos -----------------
def nlp_textblob(text):
    blob = TextBlob(text)
    sentiment = blob.sentiment
    print("TextBlob - Análisis de Sentimiento:")
    print(f"Polaridad: {sentiment.polarity}, Subjetividad: {sentiment.subjectivity}")
    print()

# ----------------- Hugging Face - Análisis de Sentimientos -----------------
def nlp_transformers(text):
    classifier = pipeline('sentiment-analysis')
    result = classifier(text)
    print("Transformers - Análisis de Sentimiento:")
    print(result)
    print()

# ----------------- Gensim - Modelado de Palabras con Word2Vec -----------------
def nlp_gensim():
    sentences = [["hola", "como", "estas"], ["yo", "estoy", "bien"], ["me", "gusta", "programar"]]
    model = Word2Vec(sentences, min_count=1)
    word_vector = model.wv['hola']
    print("Gensim - Word2Vec:")
    print(f"Vector de la palabra 'hola': {word_vector}")
    print()

# ----------------- Función principal para ejecutar todo -----------------
def main():
    text = "¡Hola! Me encanta aprender NLP y trabajar con Python. ¿Cómo estás?"

    # Llamada a las funciones de cada librería
    nlp_nltk(text)
    nlp_spacy(text)
    nlp_textblob(text)
    nlp_transformers("I love Python programming!")
    nlp_gensim()

if __name__ == "__main__":
    main()
