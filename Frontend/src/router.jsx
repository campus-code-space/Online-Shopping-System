import { createBrowserRouter } from "react-router-dom";
import React from 'react';
import Home from "./views/Home";
import SignIn from './views/SignIn';
import Register from './views/Register';
import DashboardLayout from './views/DashboardLayout';
import DiscountPage from './views/DiscountPage'
import BulkSubscription from './views/BulkSubscription'
import CartPage from "./views/CartPage";
import Unauthorized from "./views/Unauthorized";
  
      
const router = createBrowserRouter( [
    {
        path: '/',
        element: <Home/>
    },
    {
        path:"/signin",
        element:<SignIn />
    },
    {
        path:"/register",
        element:<Register />
    },    
    {
        path:"/dashboard",
        element:<DashboardLayout />
    },    
    {
        path:"/discounts",
        element:<DiscountPage />
    },
    {
        path:"/bulkSubscription",
        element:<BulkSubscription />
    },
    {
        path:"/CartPage",
        element:<CartPage/>
    },
    {
        path:"/unauthorized",
        element:<Unauthorized/>
    },
])
export default router;