import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import Detail from "../views/Detail.vue"
import PostUpdate from "../views/PostUpdate.vue"

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      name: "home",
      path: "/",
      component: HomeView,
    },
    {
      name: "creUp",
      path: "/add",
      component: PostUpdate,
    },
    {
      name: "details",
      path: "/:id",
      component: Detail,
    },
  ],
});

export default router;
