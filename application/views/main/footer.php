        <footer>
        футер
        </footer>
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/blueimp-gallery.min.js"></script>
        <script src="/js/main.js"></script>
        
<script>
document.getElementById('project_images').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {index: link, event: event},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};
</script>
        
    </body>
</html>