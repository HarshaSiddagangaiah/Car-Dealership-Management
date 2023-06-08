<!DOCTYPE html>
<html>
<head>
	<title>Car Dealership Management</title>
    <h1>Car Dealership Management</h1>
	<!-- Add any other meta tags or stylesheets here -->
    <style>
        h1 {
        text-align: center;
        }

        /* Set global styles */
* {
  box-sizing: border-box; /* Include padding and border in element's total width and height */
  font-family: "Lucida Console",monospace; /* Set font family */
}

body {
  background-color: #f7f7f7; /* Set background color */
}

/* Style the header */
header {
  background-color: #333; /* Set background color */
  color: #fff; /* Set text color */
  padding: 20px; /* Set padding */
}


table {
  border-collapse: collapse;
  font-family: "Lucida Console", monospace;
  font-size: 14px;
  color: #333;
  margin-bottom: 20px;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 4px;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

th, td {
  padding: 15px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
  font-weight: bold;
  text-transform: uppercase;
}

td {
  font-weight: normal;
}

tr:hover {
  background-color: #f5f5f5;
}

td:not(:last-child),
th:not(:last-child) {
  border-right: 1px solid #ddd;
}

tbody tr:last-child td {
  border-bottom: 0;
}

tfoot {
  font-weight: bold;
  background-color: #f2f2f2;
}

tfoot td {
  text-align: right;
  padding: 10px 15px;
  border-top: 1px solid #ccc;
}

tfoot td:first-child {
  text-align: left;
  border-right: none;
}

/* CSS */
button {
  align-items: center;
  appearance: none;
  background-color: #FCFCFD;
  border-radius: 4px;
  border-width: 0;
  box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px,rgba(45, 35, 66, 0.3) 0 7px 13px -3px,#D6D6E7 0 -3px 0 inset;
  box-sizing: border-box;
  color: #36395A;
  cursor: pointer;
  display: inline-flex;
  font-family: "Lucida Console", monospace;
  height: 36px;
  justify-content: center;
  line-height: 1;
  list-style: none;
  overflow: hidden;
  padding-left: 16px;
  padding-right: 16px;
  position: relative;
  text-align: left;
  text-decoration: none;
  transition: box-shadow .15s,transform .15s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  white-space: nowrap;
  will-change: box-shadow,transform;
  font-size: 18px;
}

button:focus {
  box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
}

button:hover {
  box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
  transform: translateY(-2px);
}

button:active {
  box-shadow: #D6D6E7 0 3px 7px inset;
  transform: translateY(2px);
}

.return-button {
  background-color: #6b5b95; /* Change this to the color you want */
  color: #fff;
  border: none;
  border-radius: 4px;
  padding: 10px 20px;
  font-size: 18px;
}


    </style>

</head>
<body>
