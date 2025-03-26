
const CartReducer = (state, action)=>{
    switch(action.type){
        case "Add":
            const existingItemIndex = state.findIndex(item => item.id === action.item.id);

            if (existingItemIndex !== -1) {
              const updatedState = [...state];
              updatedState[existingItemIndex].quantity += 1;
              return updatedState;
            } else {
              return [...state, { ...action.item, quantity: 1}];
            }
        case "Remove":
            return state.filter(item => item.id !== action.id);
        case "Increase":
            const IndexIncrease = state.findIndex(item => item.id === action.id)
            state[IndexIncrease].quantity +=1
            return[...state]
        case "Decrease":
            const IndexDecrease = state.findIndex(item => item.id === action.id)
            state[IndexDecrease].quantity -=1
            return[...state]
        default:
            state;
    }
}
export default CartReducer