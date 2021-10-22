<section id="contact">
    <h1>Contact</h1>
    <form action="#">
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" placeholder="Votre nom">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Votre e-mail">
        <label for="message">Message</label>
        <textarea id="message" name="message" placeholder="Votre message"></textarea>
        <input type="submit" value="Envoyer" onclick="event.preventDefault()">
    </form>
</section>