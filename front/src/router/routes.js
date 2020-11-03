
const routes = [
  {
    name: 'login',
    path: '/',
    component: () => import('layouts/LoginLayout.vue'),
    meta: {
      title: 'Login'
    },
    props: {
      view: 'login'
    }
  },
  {
    name: 'changepassword',
    path: '/changepassword/:token',
    component: () => import('layouts/LoginLayout.vue'),
    meta: {
      title: 'Cambiar clave'
    },
    props: {
      view: 'changepassword'
    }
  },
  {
    name: 'recovery',
    path: '/recovery',
    component: () => import('layouts/LoginLayout.vue'),
    meta: {
      title: 'Recuperar clave'
    },
    props: {
      view: 'recovery'
    }
  },
  {
    path: '/login',
    component: () => import('layouts/LoginLayout.vue'),
    meta: {
      title: 'Login'
    },
    props: {
      view: 'login'
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
    path: '/projects',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'projects'
    },
    meta: {
      title: 'Proyectos', requireSession: true
    }
  },
  {
    path: '/project/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'project'
    },
    meta: {
      title: 'Proyecto', requireSession: true
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
    path: '/var/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'var'
    },
    meta: {
      title: 'Variable', requireSession: true
    }
  },
  {
    path: '/reports',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'reports'
    },
    meta: {
      title: 'Informes', requireSession: true
    }
  },
  {
    path: '/new-report/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'new-report'
    },
    meta: {
      title: 'Crear informe', requireSession: true
    }
  },
  {
    path: '/report/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'report'
    },
    meta: {
      title: 'Informe', requireSession: true
    }
  },
  {
    path: '/graphics',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'graphics'
    },
    meta: {
      title: 'Graficas', requireSession: true
    }
  },
  {
    path: '/calculate',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'calculate'
    },
    meta: {
      title: 'Formulas', requireSession: true
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
