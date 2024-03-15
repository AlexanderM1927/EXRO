
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
      title: 'Control Programas Quimicos | Home', requireSession: true, ranks: [1, 2, 3, 4, 5, 6, 7]
    }
  },
  {
    path: '/users',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'users'
    },
    meta: {
      title: 'Control Programas Quimicos | Usuarios', requireSession: true, ranks: [1, 2, 3, 4, 5, 6, 7]
    }
  },
  {
    path: '/clients',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'clients'
    },
    meta: {
      title: 'Control Programas Quimicos | Clientes', requireSession: true, ranks: [2, 3, 4, 5, 6]
    }
  },
  {
    path: '/user/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'user'
    },
    meta: {
      title: 'Control Programas Quimicos | Usuario', requireSession: true, ranks: [2, 3, 4, 5, 6]
    }
  },
  {
    path: '/projects',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'projects'
    },
    meta: {
      title: 'Control Programas Quimicos | Tratamientos', requireSession: true, ranks: [1, 2, 3, 4, 5, 6, 7]
    }
  },
  {
    path: '/projects-client/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'projects-client'
    },
    meta: {
      title: 'Control Programas Quimicos | Tratamientos', requireSession: true, ranks: [2, 3, 4, 5, 6]
    }
  },
  {
    path: '/project/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'project'
    },
    meta: {
      title: 'Control Programas Quimicos | Tratamiento', requireSession: true, ranks: [1, 2, 3, 4, 5, 6, 7]
    }
  },
  {
    path: '/vars',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'vars'
    },
    meta: {
      title: 'Control Programas Quimicos | Variables', requireSession: true, ranks: [1, 2, 3, 4, 5, 6, 7]
    }
  },
  {
    path: '/var/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'var'
    },
    meta: {
      title: 'Control Programas Quimicos | Variable', requireSession: true, ranks: [1, 2, 3, 4, 5, 6, 7]
    }
  },
  {
    path: '/reports',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'reports'
    },
    meta: {
      title: 'Control Programas Quimicos | Informes', requireSession: true, ranks: [1, 2, 3, 4, 5, 6, 7]
    }
  },
  {
    path: '/new-report/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'new-report'
    },
    meta: {
      title: 'Control Programas Quimicos | Crear informe', requireSession: true, ranks: [1, 2, 3, 4, 5, 6, 7]
    }
  },
  {
    path: '/report/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'report'
    },
    meta: {
      title: 'Control Programas Quimicos | Informe', requireSession: true, ranks: [1, 2, 3, 4, 5, 6, 7]
    }
  },
  {
    path: '/graphics',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'graphics'
    },
    meta: {
      title: 'Control Programas Quimicos | Graficas', requireSession: true, ranks: [1, 2, 3, 4, 5, 6, 7]
    }
  },
  {
    path: '/calculate',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'calculate'
    },
    meta: {
      title: 'Control Programas Quimicos | Formulas', requireSession: true, ranks: [1, 2, 3, 4, 5, 6, 7]
    }
  },
  {
    path: '/logs',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'logs'
    },
    meta: {
      title: 'Control Programas Quimicos | Auditoria', requireSession: true, ranks: [3]
    }
  },
  {
    path: '/settings',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'settings'
    },
    meta: {
      title: 'Control Programas Quimicos | Configuración', requireSession: true, ranks: [3]
    }
  },
  {
    path: '/pqrs',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'pqrs'
    },
    meta: {
      title: 'Control Programas Quimicos | PQRS', requireSession: true, ranks: [1, 2, 3, 4, 5, 6, 7]
    }
  },
  {
    path: '/calculate/:id',
    component: () => import('layouts/MainLayout.vue'),
    props: {
      view: 'calculate-form'
    },
    meta: {
      title: 'Control Programas Quimicos | Formula: Enfriamentos de sistemas abiertos', requireSession: true, ranks: [1, 2, 3, 4, 5, 6, 7]
    }
  },
  {
    name: 'logout',
    path: '/logout',
    meta: {
      title: 'Control Programas Quimicos | logout', requireSession: true, ranks: [1, 2, 3, 4, 5, 6, 7]
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
