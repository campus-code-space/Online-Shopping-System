import { Link, useNavigate } from 'react-router-dom';
import { ShoppingBasket, LogIn, UserPlus, ShoppingCart } from 'lucide-react';
import { useState } from 'react';

export default function Home() {
  const navigate = useNavigate();
  const [cartCount, setCartCount] = useState(0);

  const handleAddToCart = () => {
    setCartCount(prevCount => prevCount + 1);
  };

  return (
    <div className="min-h-screen flex flex-col">
      {/* Header */}
      <header className="bg-green-600 text-white">
        <nav className="container mx-auto px-4 py-4 flex items-center justify-between">
          <Link to="/" className="flex items-center space-x-2">
            <ShoppingBasket size={32} />
            <span className="text-2xl font-bold">FreshMart</span>
          </Link>
          <div className="flex items-center space-x-4">
            {/* Cart Icon with Counter */}
            <div className="relative">
              <ShoppingCart size={24} />
              {cartCount > 0 && (
                <span className="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                  {cartCount}
                </span>
              )}
            </div>
            <button 
              onClick={() => navigate('/signin')}
              className="flex items-center space-x-1 px-4 py-2 rounded-lg hover:bg-green-700 transition-colors"
            >
              <LogIn size={20} />
              <span>Sign In</span>
            </button>
            <button 
              onClick={() => navigate('/register')}
              className="flex items-center space-x-1 bg-white text-green-600 px-4 py-2 rounded-lg hover:bg-green-50 transition-colors"
            >
              <UserPlus size={20} />
              <span>Register</span>
            </button>
          </div>
        </nav>
      </header>

      {/* Main Content */}
      <main className="flex-grow">
        <section className="relative h-[500px]">
          <img 
            src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=2000&q=80"
            alt="Fresh vegetables"
            className="w-full h-full object-cover"
          />
          <div className="absolute inset-0 bg-black bg-opacity-50 flex items-center">
            <div className="container mx-auto px-4 text-white">
              <h1 className="text-5xl font-bold mb-4">Fresh Groceries Delivered to Your Door</h1>
              <p className="text-xl mb-8 max-w-2xl">Shop from our wide selection of fresh produce, pantry essentials, and household items. Get same-day delivery and enjoy the convenience of online grocery shopping.</p>
              <button 
                onClick={() => navigate('/signin')}
                className="bg-green-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-green-700 transition-colors"
              >
                Start Shopping
              </button>
            </div>
          </div>
        </section>

        <section className="py-16 bg-gray-50">
          <div className="container mx-auto px-4">
            <h2 className="text-3xl font-bold text-center mb-12">Featured Product</h2>
            <div className="grid md:grid-cols-3 gap-8">
              <div className="bg-white p-6 rounded-lg shadow-sm">
                <h3 className="text-xl font-semibold mb-3">Organic Apples</h3>
                <p className="text-gray-600 mb-4">Fresh, crisp apples from local orchards - $2.99/lb</p>
                <button
                  onClick={handleAddToCart}
                  className="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors"
                >
                  Add to Cart
                </button>
              </div>
              {/* You could add more products here */}
            </div>
          </div>
        </section>
      </main>

      {/* Footer */}
      <footer className="bg-gray-800 text-gray-300">
        <div className="container mx-auto px-4 py-12">
          <div className="grid md:grid-cols-4 gap-8">
            <div>
              <h4 className="text-white text-lg font-semibold mb-4">About FreshMart</h4>
              <ul className="space-y-2">
                <li><a href="#" className="hover:text-white">About Us</a></li>
                <li><a href="#" className="hover:text-white">Careers</a></li>
                <li><a href="#" className="hover:text-white">Press</a></li>
              </ul>
            </div>
            <div>
              <h4 className="text-white text-lg font-semibold mb-4">Help</h4>
              <ul className="space-y-2">
                <li><a href="#" className="hover:text-white">FAQ</a></li>
                <li><a href="#" className="hover:text-white">Contact Us</a></li>
                <li><a href="#" className="hover:text-white">Shipping Info</a></li>
              </ul>
            </div>
            <div>
              <h4 className="text-white text-lg font-semibold mb-4">Categories</h4>
              <ul className="space-y-2">
                <li><a href="#" className="hover:text-white">Fresh Produce</a></li>
                <li><a href="#" className="hover:text-white">Dairy & Eggs</a></li>
                <li><a href="#" className="hover:text-white">Pantry Items</a></li>
              </ul>
            </div>
            <div>
              <h4 className="text-white text-lg font-semibold mb-4">Connect With Us</h4>
              <p className="mb-4">Subscribe to our newsletter for deals and updates.</p>
              <input
                type="email"
                placeholder="Enter your email"
                className="w-full px-4 py-2 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500"
              />
            </div>
          </div>
          <div className="border-t border-gray-700 mt-8 pt-8 text-center">
            <p>© 2025 FreshMart. All rights reserved.</p>
          </div>
        </div>
      </footer>
    </div>
  );
};