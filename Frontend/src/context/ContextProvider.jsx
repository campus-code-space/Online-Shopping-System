// import React from "react";
import React ,{  createContext, useReducer } from "react";
import CartReducer from "./cartReducer";

export const cartContext = createContext()

const ContextProvider = ({children}) =>{
    const [cart, dispatch] = useReducer(CartReducer, [])
    return(
        <cartContext.Provider value={{cart,dispatch}}>
            {children}
        </cartContext.Provider>
    )
}
export default ContextProvider