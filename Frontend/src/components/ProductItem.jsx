import React from 'react'
import '../index.css';
function ProductItem({ data }) {
  return (
    <li className="p-[10px] item-1 list-none">
      {/* {data} */}
      {
        // recieve image src , name of product and price of product
      }
      
      <div className="card is-loading mx-2 w-[300px] bg-white rounded shadow-md">
        <div className="shimmer image h-[200px] rounded-t">
          <img src="" alt="" />
        </div>
        <div className="content p-5">
          <h2 className="shimmer h-[30px] w-3/4 mb-4 rounded"></h2>
          <p className="shimmer h-[70px] w-full rounded"></p>
        </div>
      </div>


    </li>
  )
}

export default ProductItem