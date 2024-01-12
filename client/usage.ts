import { Configuration, AuthenticationApi, ProductsApi } from './index';

// Section 1: AuthenticationApi
const authenticationApi = new AuthenticationApi(new Configuration({
    username: 'user',
    password: 'pass',
}));
// Login
const { accessToken, user } = await authenticationApi.loginTheUser({ email: 'user', password: 'pass' })
console.log({ accessToken, user });

// Section 2: ProductsApi
const productsApi = new ProductsApi(new Configuration({
    accessToken: accessToken,
}));

// Get products
const products = await productsApi.displayAListingOfTheResource()
products?.data?.forEach(product => {
    console.log(product.name);
});
