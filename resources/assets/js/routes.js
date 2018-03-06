//import VueRouter from 'vue-router';
//const foo = { template: '<div><h1>new router view</h1></div>' }
const foo = require('./components/tst.vue');
Vue.component('abk', require('./components/messenger.vue'));
let routes = [
	{
		path: '/',
	//	component: require('./views/dashboard')
		components: {
			default: require('./views/dashboard')
	      },
	     /* children: [
	        {
	          // UserProfile will be rendered inside User's <router-view>
	          path: '/msk',
	        //  component: require('./components/tst.vue')
	          component: {
		        gh: foo
		      //  b: require('./views/listitems')
		      } 
	        }
	      ]  */
	      children: [
	        {
	          path: '/mskk',
	         // component: require('./components/tst.vue')
	          components: {
		        gh: foo
		      } 
	        }
	      ]
	},
	{
		path: '/category/:id',
		component: require('./views/categories/show')
	},
	{
		path: '/innovations',
		component: require('./views/innovations/index')
	},
	{
		path: '/innovation/create',
		component: require('./views/innovations/create')
	},
	{
		path: '/innovation/:slug',
		component: require('./views/innovations/show')
	},
	{
		path: '/:username/connections',
		component: require('./views/user/connections')
	},
	{
		path: '/my-feeds/:username',
		component: require('./views/user/myfeeds')
	},
	{
		path: '/innovator/profile/edit/:username',
		component: require('./views/user/innovator_edit')
	},
	{
		path: '/posts',
		component: require('./views/posts/index')
	},
	{
		path: '/post/:slug',
		component: require('./views/posts/show')
	},
/*	{
		path: '/:username/threads',
		component: require('./views/threads/index')
	}, */
	{
		path: '/:username/threads',
		component: require('./views/threads/index'),
		children: [
        {
          // UserProfile will be rendered inside User's <router-view>
          // when /user/:id/profile is matched
          path: '/:username/threads/:slug',
          component: require('./views/threads/show')
        }
      ]
	},
	{
		path: '/listitems',
		component: require('./views/listitems')
	},
	{
		path: '/innovator/profile/:username',
		component: require('./views/user/innovator_profile')
	},
	{
		path: '/:username/innovations',
		component: require('./views/user/person_innovations')
	},
	{
		path: '/innovation/edit/:slug',
		component: require('./views/innovations/edit')
	},
	{
		path: '/search',
		component: require('./views/search')
	}
/*	 { path: '/messengs',
      // a single route can define multiple named components
      // which will be rendered into <router-view>s with corresponding names.
      components: {
        a: Bar
      }
    }, */
	/*{
		path: '/plans',
		component: require('./views/plans/index')
	} */
];

export default new VueRouter({
	routes,
	linkActiveClass: 'is-active'
});