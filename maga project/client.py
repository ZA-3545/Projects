from openai import OpenAI

client = OpenAI(
    base_url="https://openrouter.ai/api/v1",
    api_key="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"
)

completion = client.chat.completions.create(
    model="openai/gpt-3.5-turbo",  # Note: prefix with `openai/`
    messages=[
        {"role": "system", "content": "You are a virtual assistant named Jarvis skilled in general tasks like Alexa and Google cloud "},
        {"role": "user", "content": "what is coding"}
    ]
)

print(completion.choices[0].message.content)












