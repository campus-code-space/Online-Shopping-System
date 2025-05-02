import React from 'react'
import '../index.css';
function ProductItem({ product ,loading}) {
  if(loading){

    return (
      <li className="p-[10px] item-1 list-none">
      <div className="card is-loading mx-2 w-[300px] bg-white rounded shadow-md">
        <div className="image h-[200px] rounded-t">
          <img src="" alt="" width={280} height={320} />
        </div>
        <div className="content p-5">
          <h2 className="shimmer h-[30px] w-3/4 mb-4 rounded"></h2>
          <p className="shimmer h-[70px] w-full rounded"></p>
        </div>
      </div>
    </li>
  )
  }
  if(!loading){
    return (
      <li className="p-[10px] item-1 list-none">
      <div className="card mx-2 w-[310px] bg-white rounded shadow-md">
        <div className="image h-[350px] rounded-t overflow-hidden">
          <img
          className="object-cover w-full h-full"
           src={product.product_image} alt={product.name} />
        </div>
        <div className="content p-5">
          <h2 className="text-lg font-semibold mb-2">{product.name}</h2>
          <p className="text-sm text-gray-700">{product.decription}</p>
        </div>
      </div>
    </li>
  )
}


}

export default ProductItem