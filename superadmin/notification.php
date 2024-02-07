<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: large;
            margin: 20;
            padding: 20;
        }

        #notification-form h2 {
            text-align: center;
        }

        #notification-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            position: relative;
        }

        .notification {
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            position: relative;
            transition: background-color 0.3s ease;
        }

        .notification:hover {
            background-color: #f9f9f9;
        }

        .notification.unread {
            background-color: #e6f7ff;
        }

        .notification header {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .notification time {
            color: #888;
            font-size: 12px;
        }

        #notification-count {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 50%;
        }

        select,
        button {
            margin-top: 10px;
        }

        #notification-form {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        #notification-form label {
            display: block;
            margin-bottom: 8px;
        }

        #notification-form select,
        #notification-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        #recipient-type {
            border: 1px solid black;
        }

        #recipient {
            border: 1px solid black;
        }

        #notification-message {
            border: 1px solid black;
        }



        #notification-form button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        #notification-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<?php include 'header.php'; ?>

    <!-- Notification Form and Container Section -->
    <div id="notification-form">
        <h2>Send Notification</h2>
        <label for="recipient-type">Select Recipient Type:</label>
        <select id="recipient-type">
            <option value="alladmins">All Admins</option>
            <option value="admin1">Admin1 </option>
            <option value="admins">Admin2</option>
            <option value="admins">Admin3</option>
            <option value="admins">Admin4</option>
            <option value="admins">Admin5</option>
        </select>
        <br>
        <label for="recipient">Select Recipient:</label>
        <select id="recipient"></select>
        <br>
        <label for="notification-message">Notification Message:</label>
        <textarea id="notification-message" rows="5"></textarea>
        <br>
        <button onclick="sendNotification()" class="inline-btn">Send Notification</button>
    </div>

    <!-- Unread Notification Count -->
    <div id="unread-count" class="unread-count"></div>

    <!-- Notification Container -->
    <div id="notification-container" class="notification-container"></div>

    <script>
        // Sample data for recipients
        var recipients = {
            alladmins: ['All course ', 'java', 'html', 'css'],
            admin1: ['All course ', 'java', 'html', 'css'],
            // 'all students': ['All course ', 'java', 'html', 'css'],
            // 'java-course': ['All course ', 'java', 'html', 'css'],
            // 'python-course': ['All course ', 'java', 'html', 'css'],
            // 'c-course': ['All course ', 'java', 'html', 'css'],
        };

        // Unread notification count
        var unreadCount = 0;

        // Update recipients dropdown based on the selected recipient type
        function updateRecipients() {
            var recipientType = document.getElementById('recipient-type').value;
            var recipientDropdown = document.getElementById('recipient');
            recipientDropdown.innerHTML = '';

            recipients[recipientType].forEach(function (recipient) {
                var option = document.createElement('option');
                option.value = recipient;
                option.text = recipient;
                recipientDropdown.add(option);
            });
        }

        // Send a notification to the selected recipient
        function sendNotification() {
            var recipientType = document.getElementById('recipient-type').value;
            var recipient = document.getElementById('recipient').value;
            var message = document.getElementById('notification-message').value;

            // Check if the message is not empty
            if (message.trim() === '') {
                alert('Please enter a notification message.');
                return;
            }

            // Display the notification on the page
            displayNotification(message, recipient);

            // Increment unread notification count
            unreadCount++;
            updateUnreadCount();

            // Clear the form fields
            document.getElementById('notification-message').value = '';

            // For demonstration purposes, log the notification to the console
            console.log(`Notification sent to ${recipient} (${recipientType}): ${message}`);
        }

        // Display the notification on the page
        function displayNotification(message, recipient) {
            var notificationContainer = document.getElementById('notification-container');
            var notificationElement = document.createElement('div');
            notificationElement.className = 'notification';
            notificationElement.innerHTML = `<strong>${recipient}:</strong> ${message}`;
            notificationContainer.appendChild(notificationElement);
        }

        // Update the unread notification count on the page
        function updateUnreadCount() {
            var unreadCountElement = document.getElementById('unread-count');
            unreadCountElement.textContent = ` ${unreadCount}`;
            // unreadCountElement.textContent = `Unread Notifications: ${unreadCount}`;
        }

        // Attach event listener to update recipients dropdown when recipient type changes
        document.getElementById('recipient-type').addEventListener('change', updateRecipients);

        // Initialize recipients dropdown on page load
        updateRecipients();
    </script>

    <!-- Custom JS file link -->
    <script src="js/script.js"></script>
    <?php include 'sidebar.php'; ?>
</body>

</html>