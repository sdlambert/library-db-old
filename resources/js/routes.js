import Home from "./views/Home";
import Books from "./views/Books";
import BookShow from "./views/BookShow";

const routes = [
  { path: '/', component: Home },
  { path: '/books', component: Books },
  { path: '/books/:id', component: BookShow }
];



export default routes;
