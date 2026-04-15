<div class="container">
<style>
        .container {
            width: 50%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background: white;
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, textarea {
            margin-bottom: 20px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #535432;
        }
    </style>
        <h1>Góp Ý</h1>
        <form action="submit_feedback.php" method="POST">
            <label for="name">Tên của bạn:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="feedback">Nội dung góp ý:</label>
            <textarea id="feedback" name="feedback" rows="5" required></textarea>

            <button type="submit">Gửi Góp Ý</button>
        </form>
    </div>