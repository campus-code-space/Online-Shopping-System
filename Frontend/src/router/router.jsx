import { createBrowserRouter } from "react-router-dom";
import React from 'react';
import {Home,SignIn,Register,DashboardLayout,DiscountPage,BulkSubscription,
    CartPage,Unauthorized,Signup,ProductPost,
    MyProduct,VendorPage} from '../pages.js'
import ProductList from "../components/ProductList.jsx";
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
                index:true,
                element:<ProductList/>
            },
            {
                path: 'my-products',
                element: <MyProduct />
            },
        ]
    },
    {
        path: '/vendor-management/product-post',
        element:<PrivateRoute Component={ProductPost} allowedRoles={['Vendor']} />,
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