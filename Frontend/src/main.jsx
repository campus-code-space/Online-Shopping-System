import { StrictMode } from 'react';
import { createRoot } from 'react-dom/client';
import { RouterProvider } from 'react-router-dom';
//import App from './App'
import './index.css';
import router from './router/router';
import ContextProvider from './context/contextProvider';
createRoot(document.getElementById('root')).render(
  // <StrictMode>
     <ContextProvider> 
     <RouterProvider router={router}/>

     </ContextProvider> 
       
  //  </StrictMode>
);