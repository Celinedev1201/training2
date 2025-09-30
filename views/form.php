<hr>
<h2>Ajoutez une note</h2>
<div class="note-form">
    <form method="POST" action="index.php?route=notes.store">
        <input type="text" name="title" placeholder="Titre" required>
        <textarea id="content" name="content"></textarea>
        <button type="submit">Ajouter</button>
    </form>
</div>