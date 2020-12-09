
const routes = [
  {
    name: 'login',
    path: '/',
    component: () => import('layouts/LoginLayout.vue'),
    meta: {
      title: 'Control Programas Quimicos | Login'
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
      title: 'Control Programas Quimicos | Cambiar clave'
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
      title: 'Control Programas Quimicos | Recuperar clave'
    },
    props: {
      view: 'recovery'
    }
  },
  {
    path: '/login',
    component: () => import('layouts/LoginLayout.vue'),
    meta: {
      title: 'Control Programas Quimicos | Login'
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
      title: 'Control Programas Quimicos | Home', requireSession: true
    }
  },
  {
    path: '/users',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'users'
    },
    meta: {
      title: 'Control Programas Quimicos | Usuarios', requireSession: true
    }
  },
  {
    path: '/user/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'user'
    },
    meta: {
      title: 'Control Programas Quimicos | Usuario', requireSession: true
    }
  },
  {
    path: '/projects',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'projects'
    },
    meta: {
      title: 'Control Programas Quimicos | Proyectos', requireSession: true
    }
  },
  {
    path: '/project/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'project'
    },
    meta: {
      title: 'Control Programas Quimicos | Proyecto', requireSession: true
    }
  },
  {
    path: '/vars',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'vars'
    },
    meta: {
      title: 'Control Programas Quimicos | Variables', requireSession: true
    }
  },
  {
    path: '/var/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'var'
    },
    meta: {
      title: 'Control Programas Quimicos | Variable', requireSession: true
    }
  },
  {
    path: '/reports',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'reports'
    },
    meta: {
      title: 'Control Programas Quimicos | Informes', requireSession: true
    }
  },
  {
    path: '/new-report/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'new-report'
    },
    meta: {
      title: 'Control Programas Quimicos | Crear informe', requireSession: true
    }
  },
  {
    path: '/report/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'report'
    },
    meta: {
      title: 'Control Programas Quimicos | Informe', requireSession: true
    }
  },
  {
    path: '/graphics',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'graphics'
    },
    meta: {
      title: 'Control Programas Quimicos | Graficas', requireSession: true
    }
  },
  {
    path: '/calculate',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'calculate'
    },
    meta: {
      title: 'Control Programas Quimicos | Formulas', requireSession: true
    }
  },
  {
    path: '/pqrs',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'pqrs'
    },
    meta: {
      title: 'Control Programas Quimicos | PQRS', requireSession: true
    }
  },
  {
    path: '/calculate/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'calculate-form'
    },
    meta: {
      title: 'Control Programas Quimicos | Formula: Enfriamentos de sistemas abiertos', requireSession: true
    }
  },
  {
    name: 'logout',
    path: '/logout',
    meta: {
      title: 'Control Programas Quimicos | logout', requireSession: true
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
