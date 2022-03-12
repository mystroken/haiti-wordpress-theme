/* eslint-disable no-undef */
// import Barba from 'barba.js';
import initializeApp from './app/index';

if ( typeof module === 'object' && module.hot ) {
	module.hot.accept();
}

const app = initializeApp();

// const Transition = Barba.BaseTransition.extend({
//   start() {
//     this.newContainerLoading.then(this.finish.bind(this));
//   },

//   finish() {
//     // Remove the old container.
//     this.done();
//   },
// });

// Barba.Pjax.Dom.wrapperId = 'main';
// Barba.Pjax.Dom.containerClass = 'content-wrapper';
// Barba.Pjax.getTransition = () => Transition;
// Barba.Pjax.start();

window.App = app;
