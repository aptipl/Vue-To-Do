<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            min-width: 250px;
        }

        /* Include the padding and border in an element's total width and height */
        * {
            box-sizing: border-box;
        }

        /* Remove margins and padding from the list */
        ul {
            margin: 0;
            padding: 0;
        }

        /* Style the list items */
        ul li {
            cursor: pointer;
            position: relative;
            padding: 12px 8px 12px 40px;
            list-style-type: none;
            background: #eee;
            font-size: 18px;
            transition: 0.2s;

            /* make the list items unselectable */
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Set all odd list items to a different color (zebra-stripes) */
        ul li:nth-child(odd) {
            background: #f9f9f9;
        }

        /* Darker background-color on hover */
        ul li:hover {
            background: #ddd;
        }

        /* When clicked on, add a background color and strike out text */
        ul li.checked {
            background: #888;
            color: #fff;
            text-decoration: line-through;
        }

        /* Add a "checked" mark when clicked on */
        ul li.checked::before {
            content: '';
            position: absolute;
            border-color: #fff;
            border-style: solid;
            border-width: 0 2px 2px 0;
            top: 10px;
            left: 16px;
            transform: rotate(45deg);
            height: 15px;
            width: 7px;
        }

        /* Style the close button */
        .close {
            position: absolute;
            right: 0;
            top: 0;
            padding: 12px 16px 12px 16px;
        }

        .close:hover {
            background-color: #f44336;
            color: white;
        }

        /* Style the header */
        .header {
            padding: 30px 40px;
            text-align: center;
        }

        /* Clear floats after the header */
        .header:after {
            content: "";
            display: table;
            clear: both;
        }
        .selector{
            color: white;
            text-align: center;
        }
        .selector:after {
            content: "";
            display: table;
            clear: both;
        }
        /* Style the input */
        input {
            margin: 0;
            border-radius: 0;
            width: 75%;
            padding: 10px;
            float: left;
            font-size: 16px;
        }
        .list-title{
            padding: 10px;
            width: 33.33%;
            background: #e9ecef;
            color: #555;
            float: left;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            border-radius: 0;
            border: #a9a9a9 2px solid;
        }

        .list-title:hover {
            background-color: #bbb;
        }
        .active{
            background-color: #f44336;
            color: #000;
        }
        /* Style the "Add" button */
        .addBtn {
            padding: 10px;
            width: 25%;
            background: #e9ecef;
            color: #555;
            float: left;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            border-radius: 0;
            border: 2px #a9a9a9 solid;
        }

        .addBtn:hover {
            background-color: #bbb;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="header">
            <h2 style="margin:5px">My To Do List</h2>
            <form v-on:submit.prevent="addNewTodo">
                <input  v-model="newTodoText" type="text" id="new-todo" placeholder="Title...">
                <input type="submit" class="addBtn" value="Add a todo">
            </form>
        </div>
        <div class="selector">
            <span class="list-title active">All Tasks</span>
            <span class="list-title">Pending Tasks</span>
            <span class="list-title">Completed Tasks</span>
        </div>
        <ul class="list">
            <li
                is="todo-item"
                v-for="(todo, index) in todos"
                v-bind:key="todo.id"
                v-bind:title="todo.title"
                v-bind:class="{ checked : todo.completed }"
                v-on:comepleteTask="{ todo.id }"
            ></li>
        </ul>
    </div>
</body>
</html>
<script src="./vue.js"></script>
<script>
    Vue.component('todo-item', {
        template: '\
    <li>\
      {{ title }}\
      <span class="close" v-on:click="$emit(\'comepleteTask\')">x</span>\
    </li>\
  ',
        props: ['title']
    })
    new Vue({
        el: '#app',
        data: {
            newTodoText: '',
            todos: [
                {
                    id: 1,
                    title: 'Do the dishes',
                    completed : false,
                },
                {
                    id: 2,
                    title: 'Take out the trash',
                    completed : true,
                },
                {
                    id: 3,
                    title: 'Mow the lawn',
                    completed : false,
                }
            ],
            nextTodoId: 4
        },
        methods: {
            addNewTodo: function () {
                this.todos.push({
                    id: this.nextTodoId++,
                    title: this.newTodoText
                })
                this.newTodoText = ''
            },
            comepleteTask: function (id) {
                alert(id);
            }
        }
    })
</script>