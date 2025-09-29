<footer>
    <p><small>Application codée avec ❤️</small></p>
</footer>
<!-- WYSIWYG -->
<script>
    const mde = new SimpleMDE({
        element: document.getElementById("content"),
        placeholder: "Écris ta note en Markdown…",
        spellChecker: false, // plus discret pour débuter
        status: false, // cache la barre de statut
        autosave: {
            enabled: true,
            uniqueId: "notes-app-content",
            delay: 1000
        },
        toolbar: ["bold", "italic", "heading", "|", "quote", "unordered-list", "ordered-list", "|", "link",
            "preview", "guide"
        ]
    });
</script>
</body>

</html>