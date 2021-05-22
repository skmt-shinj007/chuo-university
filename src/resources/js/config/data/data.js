import router from '../../router';

const data = {};
const pickUpRoute = (route) => {
  return router.options.routes.find(el => el.name === route);
}

// export default data;
