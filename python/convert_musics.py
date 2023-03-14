import youtube_dl
lista_musicas = [
    ''
]

for li in lista_musicas:
    video_url = li
    video_info = youtube_dl.YoutubeDL().extract_info(
        url=video_url, download=False
    )
    filename = f"Evanescence - {video_info['title']}.mp3"
    options = {
        'format': 'bestaudio/best',
        'keepvideo': False,
        'outtmpl': filename,
    }

    with youtube_dl.YoutubeDL(options) as ydl:
        ydl.download([video_info['webpage_url']])

    print("Download complete... {}".format(filename))
