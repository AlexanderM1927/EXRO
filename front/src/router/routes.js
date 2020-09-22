
const routes = [
  {
    name: 'login',
    path: '/',
    component: () => import('layouts/LoginLayout.vue'),
    meta: {
      title: 'Login'
    }
  },
  {
    path: '/login',
    component: () => import('layouts/LoginLayout.vue'),
    meta: {
      title: 'Login'
    }
  },
  {
    name: 'home',
    path: '/home',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'home'
    },
    meta: {
      title: 'Home', requireSession: true
    }
  },
  {
    path: '/users',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'users'
    },
    meta: {
      title: 'Usuarios', requireSession: true
    }
  },
  {
    path: '/user/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'user'
    },
    meta: {
      title: 'Usuario', requireSession: true
    }
  },
  {
    path: '/proyects',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'proyects'
    },
    meta: {
      title: 'Proyectos', requireSession: true
    }
  },
  {
    path: '/vars',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'vars'
    },
    meta: {
      title: 'Variables', requireSession: true
    }
  },
  {
    name: 'logout',
    path: '/logout',
    meta: {
      title: 'logout', requireSession: true
    }
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
