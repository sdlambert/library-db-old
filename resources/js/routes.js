import Home from "./views/Home";
import Books from "./views/Books";
import BookShow from "./views/BookShow";
import BookCreate from "./views/BookCreate";
import NotFound from "./components/NotFound";

const routes = [
  { name: 'home', path: '/', component: Home },
  { name: 'books', path: '/books', component: Books },
  { name: 'books-create', path: '/books/create', component: BookCreate },
  { name: 'books-id', path: '/books/:id', component: BookShow },
  { name: '404', path: "*", component: NotFound  },
];



export default routes;
