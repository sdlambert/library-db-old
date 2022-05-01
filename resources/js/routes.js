import Home from "./views/Home";
import Books from "./views/Books";
import BookShow from "./views/BookShow";
import BookCreate from "./views/BookCreate";

const routes = [
  { path: '/', component: Home },
  { path: '/books', component: Books },
  { path: '/books/create', component: BookCreate },
  { path: '/books/:id', component: BookShow },
];



export default routes;
