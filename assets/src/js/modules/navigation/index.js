import initializeNavigation from './navigation';

export default function init() {
	const toggler = document.getElementById( 'hamburgerToggle' );
	const container = document.getElementById( 'handheld-nav' );
	const handheldNavigation = initializeNavigation();
	const defaultBodyOverflowProp = document.body.style.overflow;

	toggler.addEventListener( 'click', ( event ) => {
		event.preventDefault();
		handheldNavigation.toggle();
		toggler.classList.toggle( 'is-active' );
		container.classList.toggle( 'is-visible' );
		document.body.style.overflow = handheldNavigation.isActive() ? 'hidden' : defaultBodyOverflowProp;
	} );
}
