
import colors from 'vuetify/es5/util/colors'

export default {
  mode: 'spa',
  /*
  ** Headers of the page
  */
  head: {
    title: 'PIDSR',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'It is a multi-faceted public health disease surveillance system that provides public health officials the capabilities to monitor the occurence and spread of diseases.' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/pidsr-logo.png' }
    ]
  },
  /*
  ** Customize the progress-bar color
  */
  loading: { 
    height: '3px',
    color: '#3CAEA3', 
    throttle: 0, 
    duration: 5000, 
    continuous: true,
  },
  /*
  ** Global CSS
  */
  css: [
  ],
  /*
  ** Plugins to load before mounting the App
  */
  plugins: [
    '@/plugins/main',
    '@/plugins/mdi',
    '@/plugins/helpers',
    '@/plugins/vue-apex-charts',
    '@/plugins/vue-numerals',
  ],
  /*
  ** Nuxt.js dev-modules
  */
  buildModules: [
    '@nuxtjs/vuetify',
    '@nuxtjs/pwa'
  ],
  /*
  ** Nuxt.js modules
  */
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/pwa',
    '@nuxtjs/auth',
  ],
  /*
  ** Axios module configuration
  ** See https://axios.nuxtjs.org/options
  */
  axios: {
    // baseURL: 'http://api-v2.pidsr.io/' // Local Development
    baseURL: 'https://pidsr.herokuapp.com/' // Heroku Instance
  },

  router: {
    middleware: ['auth']
  },
  
  auth: {
    strategies: {
      local: {
        endpoints: {
          login: { url: '/api/auth/login', method: 'post', propertyName: 'access_token' },
          logout: { url: '/api/auth/logout', method: 'post' },
          user: { url: '/api/auth/user', method: 'get', propertyName: false }
        },
        tokenType: 'bearer',
        autoFetchUser: true
        // autoFetchUser: false,
        // tokenRequired: true,
      }
    },
    // redirect: false,
    redirect: {
      login: '/login',
      logout: '/login',
      callback: '/login',
      home: '/dashboard',
    }
  },
  
  /**
   * transition
   */
  transition: {
    name: 'fade',
    mode: 'out-in'
  },

  layoutTransition: {
    name: 'fade',
    mode: 'out-in'
  },
  
  /**
   * vuetify module custom
   */
  vuetify: {
    customVariables: ['~/assets/variables.scss'],
    treeShake: true,
    options: {
      customProperties: true
    },
    themes: {
      dark: {
        primary: colors.indigo.darken4,
        accent: colors.grey.darken3,
        secondary: colors.amber.darken3,
        info: colors.teal.lighten1,
        warning: colors.amber.base,
        error: colors.deepOrange.accent4,
        success: colors.green.accent3
      },
    }
  },

  manifest: {
    name: 'Philippine Integrated Disease Surveillance and Response',
    crossorigin: 'use-credentials',
    short_name: 'PIDSR',
    lang: 'en',
    description: 'It is a multi-faceted public health disease surveillance system that provides public health officials the capabilities to monitor the occurence and spread of diseases.',
  },

  workbox: {
    preCaching: [
      {
        url: '/'
      },
      {
        url: '/dashboard'
      },
      {
        url: '/login'
      },
      {
        url: '/users'
      },
      {
        url: '/disease-reporting-unit'
      },
      {
        url: '/account-settings'
      },
      {
        url: '/report'
      },
      {
        url: '/report/category-selection'
      },
      {
        url: '/report/view'
      },
    ],
    runtimeCaching: [
      {
        urlPattern: 'https://pidsr.herokuapp.com/.*',
      },
    ]
  },
  
  /*
  ** Build configuration
  */
  build: {
    /*
    ** You can extend webpack config here
    */
    extend (config, ctx) {
    }
  },

  env: {
    title: 'PIDSR',
  }
}
