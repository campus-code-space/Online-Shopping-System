import { createBrowserRouter } from "react-router-dom";
import React from 'react';
import {Home,SignIn,Register,DashboardLayout,DiscountPage,BulkSubscription,
    CartPage,Unauthorized,Signup,ProductPost,
    ProductList,ProductDetail,MyProduct,
    VendorPage} from '../pages.js'
import Profile from '../views/Profile.jsx'
import PrivateRoute from "../auth/PrivateRoute";

const router = createBrowserRouter([
    {
        path: '/',
        element: <Home />
    },
    {
        path: "/signin",
        element: <SignIn />
    },
    {
        path: "/signup",
        element: <Signup />
    },
    {
        path: '/vendor-management',
        element: <PrivateRoute Component={VendorPage} allowedRoles={['Vendor']} />,
        children: [
            {
                path: 'my-products',
                element: <MyProduct />
            },
            {
                path: 'profile',
                element: <Profile />
            },
            {
                path: 'product-post',
                element: <ProductPost />
            },
        ]
    },
    {
        path: "/dashboard",
        element: <PrivateRoute Component={DashboardLayout} allowedRoles={['User']} />
    },
    {
        path: "/discounts",
        element: <DiscountPage />
    },
    {
        path: "/bulkSubscription",
        element: <BulkSubscription />
    },
    {
        path: "/CartPage",
        element: <CartPage />
    },
    {
        path: "/unauthorized",
        element: <Unauthorized />
    },
])
export default router;