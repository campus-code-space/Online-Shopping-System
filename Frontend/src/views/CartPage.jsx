import React,{ useContext } from "react"
import { cartContext } from "../context/contextProvider"



const CartPage = () =>{
    // const {cart} = useContext(cartContext)
    const {cart,dispatch} = useContext(cartContext)
    const Increase = (id) =>{
        const Index = cart.findIndex(item => item.id === id)
        if(cart[Index].quantity<12){
            dispatch({type:"Increase",id})
        }
    }
    const Decrease = (id) =>{
        const Index = cart.findIndex(item => item.id === id)
        if(cart[Index].quantity>1){
            dispatch({type:"Decrease",id})
        }
    }
    const totalQuantity = (cart) =>{
        return cart.reduce((sum, item)=> sum + item.quantity, 0)
    }
    const totalPrice = (cart) =>{
        return cart.reduce((tprice, item)=> tprice + item.quantity * item.price, 0)
    }
    return (
        <>
        <div className="p-8">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
          {/* Sample Product Cards */}
          {cart.map(item => (
            <div  className="bg-white rounded-lg shadow-sm overflow-hidden">
              <div className="h-48 bg-gray-200"></div>
              <div className="p-4">
                <h3 className="font-medium">{item.title}</h3>
                <p className="text-sm text-gray-500 mb-2">Quantities:{item.quantity}</p>
                <div className="flex items-center justify-between">
                  <span className="font-bold text-green-600">${item.price}
                  </span>
                <div className="flex items-center space-x-2">
                  <button className="bg-green-600 text-white px-3 py-1 rounded-full text-sm hover:bg-green-700 transition-colors"
                  onClick={()=>Increase(item.id)}>+</button>
                  <button className="bg-red-600 text-white px-3 py-1 rounded-full text-sm hover:bg-red-700 transition-colors" onClick={() => dispatch({type: "Remove" , id: item.id})}>Remove</button>
                  <button className="bg-yellow-600 text-white px-3 py-1 rounded-full text-sm hover:bg-yellow-700 transition-colors"
                  onClick={()=>Decrease(item.id)}>-</button>
                  </div>
                </div>
                
              </div> 
            </div>
          ))}
      
        </div>
      </div>
       {/* Cart Summary */}
       <div className="p-8">
        <div className="bg-white p-6 rounded-lg shadow-md">
          <h2 className="text-lg font-semibold">Cart Summary</h2>
          <div className="mt-4">
            <div className="flex justify-between mb-2">
              <span className="font-medium">Total Quantity:</span>
              <span>{totalQuantity(cart)}</span>
            </div>
            <div className="flex justify-between mb-2">
              <span className="font-medium">Total Price:</span>
              <span className="font-bold text-green-600">${totalPrice(cart)}</span>
            </div>
          </div>
        </div>
      </div>
      </>
    )
}
export default CartPage