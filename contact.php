<?php 
include('partials-front/menu.php'); 
include('C:\xampp\htdocs\food-order\admin\config\constants.php'); // Ensure you include the database connection
?>
<head><style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

header {
    background: #ff6347; /* Tomato color */
    color: white;
    padding: 10px 0;
    text-align: center;
}

nav ul {
    list-style: none;
    padding: 0;
}

nav ul li {
    display: inline;
    margin: 0 15px;
}

nav ul li a {
    color: white;
    text-decoration: none;
}

.contact-section {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background: white;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.contact-section h2 {
    text-align: center;
}

.contact-form {
    display: flex;
    flex-direction: column;
}

.contact-form label {
    margin: 10px 0 5px;
}

.contact-form input,
.contact-form textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.contact-form button {
    margin-top: 10px;
    padding: 10px;
    background: #ff6347; /* Tomato color */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.contact-form button:hover {
    background: #e5533d; /* Darker tomato color */
}

footer {
    text-align: center;
    padding: 10px 0;
    background: #333;
    color: white;
    position: relative;
    bottom: 0;
    width: 100%;
}</style></head>
    <main>
        <section class="contact-section">
            <h2>Get in Touch</h2>
            <form action="#" method="post" class="contact-form">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </section>
    </main>

    <?php include('partials-front/footer.php'); ?>
</body>
</html>