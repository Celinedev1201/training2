<!-- Formulaire de recherche -->
<form method="GET" action="index.php" class="search-form">
    <input type="hidden" name="route" value="notes.index">
    <input type="text" name="search" placeholder="Rechercher une note..."
        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">

    <div class="search-options">
        <label>
            <input type="radio" name="filter" value="title"
                <?= (($_GET['filter'] ?? '') === 'title') ? 'checked' : '' ?>>
            Titre
        </label>
        <label>
            <input type="radio" name="filter" value="content"
                <?= (($_GET['filter'] ?? '') === 'content') ? 'checked' : '' ?>>
            Contenu
        </label>
        <label>
            <input type="radio" name="filter" value="both"
                <?= (($_GET['filter'] ?? 'both') === 'both') ? 'checked' : '' ?>>
            Les deux
        </label>
    </div>

    <button type="submit">🔍 Rechercher</button>
</form>


<!-- Liste des notes -->

<ul class="notes-list">
    <?php foreach ($notes as $note): ?>
    <li class="note-item">
        <strong><?= htmlspecialchars($note['title']) ?></strong>

        <!-- zone pour afficher le Markdown -->
        <div class="rendered" data-md="<?= htmlspecialchars($note['content'], ENT_QUOTES) ?>"></div>

        <small><?= $note['created_at'] ?></small>
        <a href="index.php?route=notes.delete&id=<?= $note['id'] ?>">❌ Supprimer</a>
    </li>
    <?php endforeach; ?>
</ul>

<!-- Pagination -->
<?php if ($totalPages > 1): ?>
<nav class="pagination-buttons">
    <?php if ($page > 1): ?>
    <a href="index.php?route=notes.index&page=<?= $page - 1 ?>">⬅</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
    <a href="index.php?route=notes.index&page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>">
        <?= $i ?>
    </a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
    <a href="index.php?route=notes.index&page=<?= $page + 1 ?>">➡</a>
    <?php endif; ?>
</nav>
<?php endif; ?>


<!-- SCRIPT UNIQUE pour toutes les notes -->
<script>
document.querySelectorAll('.rendered').forEach(el => {
    const raw = el.dataset.md; // récupère le contenu Markdown
    const html = marked.parse(raw); // convertit en HTML
    el.innerHTML = DOMPurify.sanitize(html); // sécurise le HTML
});
</script>