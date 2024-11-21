<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Lista de Vídeos</title>
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Lista de Vídeos</h1>
        <p>Adicione o link de um vídeo, um título e uma descrição para organizá-los.</p>

        <!-- Formulário para adicionar vídeos -->
        <form id="videoForm" class="mb-4">
            <div class="mb-2">
                <input type="text" id="videoTitle" class="form-control" placeholder="Título do vídeo">
            </div>
            <div class="mb-2">
                <input type="text" id="videoDescription" class="form-control" placeholder="Descrição do vídeo">
            </div>
            <div class="input-group mb-3">
                <input type="text" id="videoUrl" class="form-control" placeholder="Digite a URL do vídeo (ex: https://www.youtube.com/watch?v=...)">
                <button type="submit" class="btn btn-primary">Adicionar Vídeo</button>
            </div>
        </form>

        <!-- Campo de pesquisa -->
        <input type="text" id="searchBar" class="form-control mb-4" placeholder="Pesquise pelo título ou descrição">

        <!-- Lista de vídeos -->
        <div id="videoList" class="row row-cols-1 row-cols-md-2 g-4">
            <!-- Os vídeos adicionados aparecerão aqui -->
        </div>
    </div>

    <!-- Modal para exibir o vídeo em tela cheia -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Vídeo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="modalIframe" class="w-100" height="400" src="" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <script>
        const videoForm = document.getElementById('videoForm');
        const videoList = document.getElementById('videoList');
        const searchBar = document.getElementById('searchBar');
        const videoModal = new bootstrap.Modal(document.getElementById('videoModal'));
        const modalIframe = document.getElementById('modalIframe');

        // Função para salvar e carregar vídeos do LocalStorage
        const saveVideos = (videos) => localStorage.setItem('videos', JSON.stringify(videos));
        const loadVideos = () => JSON.parse(localStorage.getItem('videos')) || [];

        // Função para adicionar um vídeo
        const addVideo = (title, description, url) => {
            const videoIdMatch = url.match(/(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/);
            if (videoIdMatch && videoIdMatch[1]) {
                const videoId = videoIdMatch[1];
                const embedUrl = `https://www.youtube.com/embed/${videoId}`;
                
                const videos = loadVideos();
                videos.push({ title, description, embedUrl });
                saveVideos(videos);
                renderVideos(videos);
            } else {
                alert("Por favor, insira um link válido do YouTube.");
            }
        };

        // Função para renderizar vídeos
        const renderVideos = (videos) => {
            videoList.innerHTML = '';
            videos.forEach((video, index) => {
                const videoCard = document.createElement('div');
                videoCard.className = 'col';
                videoCard.innerHTML = `
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">${video.title}</h5>
                            <p class="card-text">${video.description}</p>
                            <iframe class="w-100" height="200" src="${video.embedUrl}" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <button class="btn btn-danger btn-sm" onclick="removeVideo(${index})">Remover</button>
                            <button class="btn btn-secondary btn-sm" onclick="viewInModal('${video.embedUrl}')">Ver em Tela Cheia</button>
                        </div>
                    </div>`;
                videoList.appendChild(videoCard);
            });
        };

        // Evento para adicionar um vídeo ao submeter o formulário
        videoForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const title = document.getElementById('videoTitle').value;
            const description = document.getElementById('videoDescription').value;
            const url = document.getElementById('videoUrl').value;
            
            addVideo(title, description, url);
            videoForm.reset();
        });

        // Função para remover um vídeo
        const removeVideo = (index) => {
            const videos = loadVideos();
            videos.splice(index, 1);
            saveVideos(videos);
            renderVideos(videos);
        };

        // Função para visualizar o vídeo em tela cheia
        const viewInModal = (embedUrl) => {
            modalIframe.src = embedUrl;
            videoModal.show();
        };

        // Limpa o iframe ao fechar o modal
        document.getElementById('videoModal').addEventListener('hidden.bs.modal', () => {
            modalIframe.src = '';
        });

        // Filtrar vídeos na pesquisa
        searchBar.addEventListener('input', (event) => {
            const searchTerm = event.target.value.toLowerCase();
            const videos = loadVideos().filter(video =>
                video.title.toLowerCase().includes(searchTerm) ||
                video.description.toLowerCase().includes(searchTerm)
            );
            renderVideos(videos);
        });

        // Carrega os vídeos do localStorage ao iniciar
        document.addEventListener('DOMContentLoaded', () => {
            renderVideos(loadVideos());
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
