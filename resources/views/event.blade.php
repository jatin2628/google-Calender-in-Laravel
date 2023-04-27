<!DOCTYPE html>
<html>
  <head>
    <title>Create New Event</title>
    <style>
      body{
        margin: 0;
        padding: 0;
        background-color: #036d6d9f;
        color: black;
      }
      .form 
      {
        display: flex;;
        justify-content: center;
        text-align: center;
        /* margin-left: auto;
        margin-right: auto; */
        
      }

      form{
        width: 30%;
      }
      input,textarea{
        border: 2px solid white;
        padding: 6px;
        border-radius: 10px;
        width: 80%;
        margin: 2px;
        /* background: transparent;
        opacity: 100%; */
      }
      label{
        font-size: 20px;
        font-weight: 480;
        color: rgb(49, 33, 4);
      }
      h1{
        margin-top: 50px;
        margin-left: 280px;
        text-align: center;
      }
      .btn{
        border: 2px solid white;
        padding: 5px;
        background-color: #0119199f;
        color: white;
        border-radius: 5px;
        cursor: pointer;
      }
      .btn:hover{
        background: #fff;
        color: #0119199f;
        border: 2px solid #0119199f;
        font-weight: bold;
      }

      .navbar{
        background-color: black;
        padding: 2px;
      }
      .navbar nav li{
        display: inline;
        margin: 10px;
        
        
      }
      a{
        text-decoration: none;
        list-style: none;
        padding: 3px;
        color: #fff;
      }
      footer{
        background-color: black;
        color: #fff;
        height: 3rem;
        display: flex;
        margin: auto;
        align-items: center;
        justify-content: center;
        position: fixed;
        bottom: 0px;
        width: 100%;
        
      }
      img{
        width: 20%;
        margin-right: 40px;
        border-radius: 10px;
      }
      p{
        padding: 3px;
        margin: 4PX;
      }
      </style>
  </head>
  <body>
    <div class="navbar">
    <nav>
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/">About</a></li>
        <li><a href="/">Services</a></li>
        <li><a href="/">Contact Us</a></li>
      </ul>
    </nav>
  </div>
    <h1>Create New Event</h1>
    <div class="form">
    <img src="C:\Users\Dell\Desktop\calendarTaskInLaravel\resources\views\boy.jpg" alt="">
    <form action="/event" method="POST">
        @csrf
      <label for="summary">Summary:</label><br>
      <input type="text" id="summary" name="summary" required><br>
      <label for="location">Location:</label><br>
      <input type="text" id="location" name="location"><br>
      <label for="description">Description:</label><br>
      <textarea id="description" name="description"></textarea><br>
      <label for="start">Start Date and Time:</label><br>
      <input type="datetime-local" id="start" name="start" required><br>
      <label for="end">End Date and Time:</label><br>
      <input type="datetime-local" id="end" name="end" required><br>
      <br>
      <button class="btn" type="submit">Create Event</button>
    </form>
  </div>
  <footer>
    <p>copyright &copy 2023</p> 
  </footer>
  </body>
</html>
