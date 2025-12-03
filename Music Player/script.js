const audio = document.getElementById("audio");
const playBtn = document.getElementById("playBtn");
let currentTrack = null;

document.querySelectorAll(".song-item").forEach(item => {
    const btn = item.querySelector(".play-btn");
    btn.addEventListener("click", () => {
        const src = item.dataset.src;
        const title = item.dataset.title;
        const artist = item.dataset.artist;

        audio.src = src;   // must be correct relative path
        audio.play();

        document.getElementById("now-title").textContent = title;
        document.getElementById("now-artist").textContent = artist;

        playBtn.textContent = "⏸";
    });
});
