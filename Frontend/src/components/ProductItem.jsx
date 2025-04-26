import React from 'react'
import '../index.css';
function ProductItem({ data }) {
  return (
    <li className="p-[10px] item-1 list-none">
      {/* {data} */}
      <div class="card is-loading mx-2 w-[300px] bg-white rounded shadow-md">
        <div class="shimmer image h-[200px] rounded-t"></div>
        <div class="content p-5">
          <h2 class="shimmer h-[30px] w-3/4 mb-4 rounded"></h2>
          <p class="shimmer h-[70px] w-full rounded"></p>
        </div>
      </div>


    </li>
  )
}

export default ProductItem