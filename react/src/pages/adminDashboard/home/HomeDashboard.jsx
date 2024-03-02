import React, { useEffect } from 'react'
import useStats from '@/hooks/stats/useStats'

export default function HomeDashboard() {

  const { statsHome, getDashboardHome } = useStats()

  useEffect(() => {
    getDashboardHome()
  }, [])

  return (
      <>
        <section className='py-8'>
          <div className='container px-4 mx-auto'>
            <div className='flex flex-wrap -m-4'>
              <div className='w-full md:w-1/2 lg:w-1/4 p-4'>
                <div className='p-6 rounded bg-emerald-50	'>
                  <div className='flex mb-2'>
                    <span className='inline-block mr-2'>
                      <svg
                        width={18}
                        height={18}
                        viewBox='0 0 18 18'
                        fill='none'
                        xmlns='http://www.w3.org/2000/svg'
                      >
                        <path
                          d='M9.00013 0.666656C7.90578 0.666656 6.82215 0.882205 5.8111 1.30099C4.80006 1.71978 3.8814 2.33361 3.10758 3.10743C1.54477 4.67024 0.666799 6.78985 0.666799 8.99999C0.659514 10.9243 1.32579 12.7904 2.55013 14.275L0.883466 15.9417C0.767834 16.0588 0.689504 16.2077 0.658359 16.3693C0.627214 16.531 0.64465 16.6982 0.708466 16.85C0.777681 16.9999 0.889886 17.1259 1.03084 17.212C1.17179 17.298 1.33513 17.3403 1.50013 17.3333H9.00013C11.2103 17.3333 13.3299 16.4553 14.8927 14.8925C16.4555 13.3297 17.3335 11.2101 17.3335 8.99999C17.3335 6.78985 16.4555 4.67024 14.8927 3.10743C13.3299 1.54463 11.2103 0.666656 9.00013 0.666656ZM9.00013 15.6667H3.50847L4.28347 14.8917C4.43868 14.7355 4.52579 14.5243 4.52579 14.3042C4.52579 14.084 4.43868 13.8728 4.28347 13.7167C3.19229 12.6267 2.51278 11.1921 2.36071 9.65732C2.20864 8.12253 2.59342 6.58249 3.44949 5.29959C4.30556 4.01669 5.57996 3.07029 7.05556 2.62163C8.53117 2.17298 10.1167 2.24983 11.542 2.83908C12.9673 3.42834 14.1442 4.49355 14.8722 5.85323C15.6002 7.21291 15.8342 8.78294 15.5344 10.2958C15.2346 11.8087 14.4196 13.1709 13.2281 14.1502C12.0366 15.1295 10.5424 15.6654 9.00013 15.6667ZM13.1668 8.16666H4.83347C4.61245 8.16666 4.40049 8.25445 4.24421 8.41073C4.08793 8.56701 4.00013 8.77898 4.00013 8.99999C4.00013 9.221 4.08793 9.43296 4.24421 9.58924C4.40049 9.74553 4.61245 9.83332 4.83347 9.83332H13.1668C13.3878 9.83332 13.5998 9.74553 13.7561 9.58924C13.9123 9.43296 14.0001 9.221 14.0001 8.99999C14.0001 8.77898 13.9123 8.56701 13.7561 8.41073C13.5998 8.25445 13.3878 8.16666 13.1668 8.16666ZM11.5001 11.5H6.50013C6.27912 11.5 6.06716 11.5878 5.91088 11.7441C5.7546 11.9003 5.6668 12.1123 5.6668 12.3333C5.6668 12.5543 5.7546 12.7663 5.91088 12.9226C6.06716 13.0789 6.27912 13.1667 6.50013 13.1667H11.5001C11.7211 13.1667 11.9331 13.0789 12.0894 12.9226C12.2457 12.7663 12.3335 12.5543 12.3335 12.3333C12.3335 12.1123 12.2457 11.9003 12.0894 11.7441C11.9331 11.5878 11.7211 11.5 11.5001 11.5ZM6.50013 6.49999H11.5001C11.7211 6.49999 11.9331 6.41219 12.0894 6.25591C12.2457 6.09963 12.3335 5.88767 12.3335 5.66666C12.3335 5.44564 12.2457 5.23368 12.0894 5.0774C11.9331 4.92112 11.7211 4.83332 11.5001 4.83332H6.50013C6.27912 4.83332 6.06716 4.92112 5.91088 5.0774C5.7546 5.23368 5.6668 5.44564 5.6668 5.66666C5.6668 5.88767 5.7546 6.09963 5.91088 6.25591C6.06716 6.41219 6.27912 6.49999 6.50013 6.49999Z'
                          fill='#382CDD'
                        />
                      </svg>
                    </span>
                    <h3 className='text-sm text-gray-600'>Total alquileres</h3>
                    {/* <span className='inline-block ml-auto px-2 py-1 text-xs text-gray-500 bg-gray-50 rounded-full'>
                      30 Days
                    </span> */}
                  </div>
                  <h2 className='mb-2 text-3xl font-bold'>{statsHome.totalRent}</h2>
                  <span className='text-xs text-red-500'>
                    <span className='inline-block mr-2'>
                      <svg
                        width={18}
                        height={10}
                        viewBox='0 0 18 10'
                        fill='none'
                        xmlns='http://www.w3.org/2000/svg'
                      >
                        <path
                          d='M16.5 4.16667C16.3906 4.16661 16.2822 4.18812 16.181 4.22998C16.0799 4.27183 15.988 4.33322 15.9106 4.41061C15.8332 4.488 15.7719 4.57989 15.73 4.68103C15.6881 4.78216 15.6666 4.89055 15.6667 5V7.15495L10.4225 1.91084C10.3452 1.83344 10.2533 1.77204 10.1522 1.73015C10.0511 1.68825 9.94277 1.66669 9.83333 1.66669C9.7239 1.66669 9.61554 1.68825 9.51445 1.73015C9.41335 1.77204 9.3215 1.83344 9.24414 1.91084L6.50002 4.65495L2.08919 0.244171C1.93245 0.0902454 1.72127 0.00444584 1.50159 0.00544068C1.28191 0.00643553 1.07151 0.094144 0.91617 0.249483C0.760831 0.404822 0.673123 0.61522 0.672128 0.8349C0.671133 1.05458 0.756932 1.26576 0.910858 1.4225L5.91086 6.4225C5.98822 6.4999 6.08007 6.5613 6.18116 6.60319C6.28226 6.64508 6.39062 6.66665 6.50005 6.66665C6.60948 6.66665 6.71784 6.64508 6.81893 6.60319C6.92003 6.5613 7.01188 6.4999 7.08924 6.4225L9.83336 3.67839L14.4883 8.33334H12.3334C12.1123 8.33334 11.9004 8.42113 11.7441 8.57741C11.5878 8.7337 11.5 8.94566 11.5 9.16667C11.5 9.38768 11.5878 9.59965 11.7441 9.75593C11.9004 9.91221 12.1123 10 12.3334 10H16.5C16.6095 10.0001 16.7179 9.97855 16.819 9.9367C16.9201 9.89484 17.012 9.83346 17.0894 9.75607C17.1668 9.67867 17.2282 9.58678 17.2701 9.48565C17.3119 9.38452 17.3334 9.27612 17.3334 9.16667V5C17.3334 4.89055 17.3119 4.78216 17.2701 4.68103C17.2282 4.57989 17.1668 4.488 17.0894 4.41061C17.012 4.33322 16.9201 4.27183 16.819 4.22998C16.7179 4.18812 16.6095 4.16661 16.5 4.16667Z'
                          fill='#E85444'
                        />
                      </svg>
                    </span>
                    {/* <span>25% less</span> */}
                  </span>
                </div>
              </div>
              <div className='w-full md:w-1/2 lg:w-1/4 p-4'>
                <div className='p-6 rounded bg-emerald-50'>
                  <div className='flex mb-2'>
                    <span className='inline-block mr-2'>
                      <svg
                        width={18}
                        height={16}
                        viewBox='0 0 18 16'
                        fill='none'
                        xmlns='http://www.w3.org/2000/svg'
                      >
                        <path
                          d='M14.8334 3.41668H12.3334V2.58334C12.3334 1.9203 12.07 1.28442 11.6012 0.815577C11.1323 0.346736 10.4965 0.0833435 9.83342 0.0833435H8.16675C7.50371 0.0833435 6.86782 0.346736 6.39898 0.815577C5.93014 1.28442 5.66675 1.9203 5.66675 2.58334V3.41668H3.16675C2.50371 3.41668 1.86782 3.68007 1.39898 4.14891C0.93014 4.61775 0.666748 5.25363 0.666748 5.91668V13.4167C0.666748 14.0797 0.93014 14.7156 1.39898 15.1844C1.86782 15.6533 2.50371 15.9167 3.16675 15.9167H14.8334C15.4965 15.9167 16.1323 15.6533 16.6012 15.1844C17.07 14.7156 17.3334 14.0797 17.3334 13.4167V5.91668C17.3334 5.25363 17.07 4.61775 16.6012 4.14891C16.1323 3.68007 15.4965 3.41668 14.8334 3.41668ZM7.33342 2.58334C7.33342 2.36233 7.42121 2.15037 7.57749 1.99409C7.73377 1.83781 7.94573 1.75001 8.16675 1.75001H9.83342C10.0544 1.75001 10.2664 1.83781 10.4227 1.99409C10.579 2.15037 10.6667 2.36233 10.6667 2.58334V3.41668H7.33342V2.58334ZM15.6667 13.4167C15.6667 13.6377 15.579 13.8497 15.4227 14.0059C15.2664 14.1622 15.0544 14.25 14.8334 14.25H3.16675C2.94573 14.25 2.73377 14.1622 2.57749 14.0059C2.42121 13.8497 2.33341 13.6377 2.33341 13.4167V8.83334C3.14628 9.15577 3.9819 9.41759 4.83342 9.61668V10.1083C4.83342 10.3294 4.92121 10.5413 5.07749 10.6976C5.23377 10.8539 5.44573 10.9417 5.66675 10.9417C5.88776 10.9417 6.09972 10.8539 6.256 10.6976C6.41228 10.5413 6.50008 10.3294 6.50008 10.1083V9.93334C7.3287 10.0462 8.16382 10.1046 9.00008 10.1083C9.83634 10.1046 10.6715 10.0462 11.5001 9.93334V10.1083C11.5001 10.3294 11.5879 10.5413 11.7442 10.6976C11.9004 10.8539 12.1124 10.9417 12.3334 10.9417C12.5544 10.9417 12.7664 10.8539 12.9227 10.6976C13.079 10.5413 13.1667 10.3294 13.1667 10.1083V9.61668C14.0183 9.41759 14.8539 9.15577 15.6667 8.83334V13.4167ZM15.6667 7.00834C14.8562 7.35042 14.0204 7.62904 13.1667 7.84168V7.58334C13.1667 7.36233 13.079 7.15037 12.9227 6.99409C12.7664 6.83781 12.5544 6.75001 12.3334 6.75001C12.1124 6.75001 11.9004 6.83781 11.7442 6.99409C11.5879 7.15037 11.5001 7.36233 11.5001 7.58334V8.20001C9.84279 8.45004 8.15737 8.45004 6.50008 8.20001V7.58334C6.50008 7.36233 6.41228 7.15037 6.256 6.99409C6.09972 6.83781 5.88776 6.75001 5.66675 6.75001C5.44573 6.75001 5.23377 6.83781 5.07749 6.99409C4.92121 7.15037 4.83342 7.36233 4.83342 7.58334V7.85834C3.97977 7.6457 3.14392 7.36709 2.33341 7.02501V5.91668C2.33341 5.69566 2.42121 5.4837 2.57749 5.32742C2.73377 5.17114 2.94573 5.08334 3.16675 5.08334H14.8334C15.0544 5.08334 15.2664 5.17114 15.4227 5.32742C15.579 5.4837 15.6667 5.69566 15.6667 5.91668V7.00834Z'
                          fill='#382CDD'
                        />
                      </svg>
                    </span>
                    <h3 className='text-sm text-gray-600'>Total Slots</h3>
                    {/* <span className='inline-block ml-auto px-2 py-1 text-xs text-gray-500 bg-gray-50 rounded-full'>
                      30 Days
                    </span> */}
                  </div>
                  <h2 className='mb-2 text-3xl font-bold'>{statsHome.totalSlots}</h2>
                  <span className='text-xs text-green-500'>
                    <span className='inline-block mr-2'>
                      <svg
                        width={18}
                        height={10}
                        viewBox='0 0 18 10'
                        fill='none'
                        xmlns='http://www.w3.org/2000/svg'
                      >
                        <path
                          d='M16.5 5.83333C16.3906 5.83339 16.2822 5.81188 16.181 5.77002C16.0799 5.72817 15.988 5.66678 15.9106 5.58939C15.8332 5.512 15.7719 5.42011 15.73 5.31897C15.6881 5.21784 15.6666 5.10945 15.6667 5V2.84505L10.4225 8.08916C10.3452 8.16656 10.2533 8.22796 10.1522 8.26985C10.0511 8.31175 9.94277 8.33331 9.83333 8.33331C9.7239 8.33331 9.61554 8.31175 9.51445 8.26985C9.41335 8.22796 9.3215 8.16656 9.24414 8.08916L6.50002 5.34505L2.08919 9.75583C1.93245 9.90975 1.72127 9.99555 1.50159 9.99456C1.28191 9.99356 1.07151 9.90586 0.91617 9.75052C0.760831 9.59518 0.673123 9.38478 0.672128 9.1651C0.671133 8.94542 0.756932 8.73424 0.910858 8.5775L5.91086 3.5775C5.98822 3.5001 6.08007 3.4387 6.18116 3.39681C6.28226 3.35492 6.39062 3.33335 6.50005 3.33335C6.60948 3.33335 6.71784 3.35492 6.81893 3.39681C6.92003 3.4387 7.01188 3.5001 7.08924 3.5775L9.83336 6.32161L14.4883 1.66666H12.3334C12.1123 1.66666 11.9004 1.57887 11.7441 1.42259C11.5878 1.2663 11.5 1.05434 11.5 0.833329C11.5 0.612315 11.5878 0.400352 11.7441 0.244073C11.9004 0.0877924 12.1123 -4.76837e-06 12.3334 -4.76837e-06H16.5C16.6095 -6.67572e-05 16.7179 0.0214453 16.819 0.063302C16.9201 0.105159 17.012 0.166539 17.0894 0.243935C17.1668 0.321329 17.2282 0.413218 17.2701 0.514352C17.3119 0.615484 17.3334 0.723876 17.3334 0.833329V5C17.3334 5.10945 17.3119 5.21784 17.2701 5.31897C17.2282 5.42011 17.1668 5.512 17.0894 5.58939C17.012 5.66678 16.9201 5.72817 16.819 5.77002C16.7179 5.81188 16.6095 5.83339 16.5 5.83333Z'
                          fill='#17BB84'
                        />
                      </svg>
                    </span>
                    {/* <span>Incidencias</span> */}
                  </span>
                </div>
              </div>
              <div className='w-full md:w-1/2 lg:w-1/4 p-4'>
                <div className='p-6 rounded bg-emerald-50'>
                  <div className='flex mb-2'>
                    <span className='inline-block mr-2'>
                      <svg
                        width={14}
                        height={18}
                        viewBox='0 0 14 18'
                        fill='none'
                        xmlns='http://www.w3.org/2000/svg'
                      >
                        <path
                          d='M13.6666 6.44999C13.6579 6.37344 13.6411 6.29802 13.6166 6.22499V6.14999C13.5765 6.06431 13.5231 5.98554 13.4583 5.91666L8.45825 0.916656C8.38936 0.851837 8.3106 0.798391 8.22492 0.758323H8.14992C8.06526 0.709774 7.97177 0.67861 7.87492 0.666656H2.83325C2.17021 0.666656 1.53433 0.930049 1.06548 1.39889C0.596644 1.86773 0.333252 2.50362 0.333252 3.16666V14.8333C0.333252 15.4964 0.596644 16.1322 1.06548 16.6011C1.53433 17.0699 2.17021 17.3333 2.83325 17.3333H11.1666C11.8296 17.3333 12.4655 17.0699 12.9344 16.6011C13.4032 16.1322 13.6666 15.4964 13.6666 14.8333V6.49999C13.6666 6.49999 13.6666 6.49999 13.6666 6.44999ZM8.66658 3.50832L10.8249 5.66666H9.49992C9.2789 5.66666 9.06694 5.57886 8.91066 5.42258C8.75438 5.2663 8.66658 5.05434 8.66658 4.83332V3.50832ZM11.9999 14.8333C11.9999 15.0543 11.9121 15.2663 11.7558 15.4226C11.5996 15.5789 11.3876 15.6667 11.1666 15.6667H2.83325C2.61224 15.6667 2.40028 15.5789 2.244 15.4226C2.08772 15.2663 1.99992 15.0543 1.99992 14.8333V3.16666C1.99992 2.94564 2.08772 2.73368 2.244 2.5774C2.40028 2.42112 2.61224 2.33332 2.83325 2.33332H6.99992V4.83332C6.99992 5.49636 7.26331 6.13225 7.73215 6.60109C8.20099 7.06993 8.83688 7.33332 9.49992 7.33332H11.9999V14.8333Z'
                          fill='#382CDD'
                        />
                      </svg>
                    </span>
                    <h3 className='text-sm text-gray-600'>Total Usuarios</h3>
                    {/* <span className='inline-block ml-auto px-2 py-1 text-xs text-gray-500 bg-gray-50 rounded-full'>
                      30 Days
                    </span> */}
                  </div>
                  <h2 className='mb-2 text-3xl font-bold'>{statsHome.totalUsers}</h2>
                  <span className='text-xs text-green-500'>
                    <span className='inline-block mr-2'>
                      <svg
                        width={18}
                        height={10}
                        viewBox='0 0 18 10'
                        fill='none'
                        xmlns='http://www.w3.org/2000/svg'
                      >
                        <path
                          d='M16.5 5.83333C16.3906 5.83339 16.2822 5.81188 16.181 5.77002C16.0799 5.72817 15.988 5.66678 15.9106 5.58939C15.8332 5.512 15.7719 5.42011 15.73 5.31897C15.6881 5.21784 15.6666 5.10945 15.6667 5V2.84505L10.4225 8.08916C10.3452 8.16656 10.2533 8.22796 10.1522 8.26985C10.0511 8.31175 9.94277 8.33331 9.83333 8.33331C9.7239 8.33331 9.61554 8.31175 9.51445 8.26985C9.41335 8.22796 9.3215 8.16656 9.24414 8.08916L6.50002 5.34505L2.08919 9.75583C1.93245 9.90975 1.72127 9.99555 1.50159 9.99456C1.28191 9.99356 1.07151 9.90586 0.91617 9.75052C0.760831 9.59518 0.673123 9.38478 0.672128 9.1651C0.671133 8.94542 0.756932 8.73424 0.910858 8.5775L5.91086 3.5775C5.98822 3.5001 6.08007 3.4387 6.18116 3.39681C6.28226 3.35492 6.39062 3.33335 6.50005 3.33335C6.60948 3.33335 6.71784 3.35492 6.81893 3.39681C6.92003 3.4387 7.01188 3.5001 7.08924 3.5775L9.83336 6.32161L14.4883 1.66666H12.3334C12.1123 1.66666 11.9004 1.57887 11.7441 1.42259C11.5878 1.2663 11.5 1.05434 11.5 0.833329C11.5 0.612315 11.5878 0.400352 11.7441 0.244073C11.9004 0.0877924 12.1123 -4.76837e-06 12.3334 -4.76837e-06H16.5C16.6095 -6.67572e-05 16.7179 0.0214453 16.819 0.063302C16.9201 0.105159 17.012 0.166539 17.0894 0.243935C17.1668 0.321329 17.2282 0.413218 17.2701 0.514352C17.3119 0.615484 17.3334 0.723876 17.3334 0.833329V5C17.3334 5.10945 17.3119 5.21784 17.2701 5.31897C17.2282 5.42011 17.1668 5.512 17.0894 5.58939C17.012 5.66678 16.9201 5.72817 16.819 5.77002C16.7179 5.81188 16.6095 5.83339 16.5 5.83333Z'
                          fill='#17BB84'
                        />
                      </svg>
                    </span>
                    {/* <span>12.5% more</span> */}
                  </span>
                </div>
              </div>
              <div className='w-full md:w-1/2 lg:w-1/4 p-4'>
                <div className='p-6 rounded bg-emerald-50'>
                  <div className='flex mb-2'>
                    <span className='inline-block mr-2'>
                      <svg
                        width={18}
                        height={18}
                        viewBox='0 0 18 18'
                        fill='none'
                        xmlns='http://www.w3.org/2000/svg'
                      >
                        <path
                          d='M11.3413 9.23332C11.8687 8.66686 12.1659 7.92397 12.1746 7.14999C12.1746 6.31456 11.8427 5.51334 11.252 4.9226C10.6612 4.33186 9.86003 3.99999 9.02459 3.99999C8.18916 3.99999 7.38795 4.33186 6.79721 4.9226C6.20647 5.51334 5.87459 6.31456 5.87459 7.14999C5.88329 7.92397 6.18045 8.66686 6.70793 9.23332C5.97347 9.59905 5.34144 10.1416 4.86869 10.8122C4.39594 11.4828 4.09728 12.2604 3.99959 13.075C3.97528 13.296 4.03976 13.5176 4.17885 13.6911C4.31794 13.8646 4.52025 13.9757 4.74126 14C4.96227 14.0243 5.18389 13.9598 5.35736 13.8207C5.53084 13.6816 5.64195 13.4793 5.66626 13.2583C5.7657 12.4509 6.15696 11.7078 6.76633 11.1689C7.3757 10.63 8.16111 10.3325 8.97459 10.3325C9.78808 10.3325 10.5735 10.63 11.1829 11.1689C11.7922 11.7078 12.1835 12.4509 12.2829 13.2583C12.3061 13.472 12.4109 13.6685 12.5756 13.8067C12.7402 13.9449 12.9518 14.0141 13.1663 14H13.2579C13.4764 13.9749 13.676 13.8644 13.8134 13.6927C13.9508 13.521 14.0147 13.302 13.9913 13.0833C13.9008 12.273 13.6116 11.4975 13.1493 10.8259C12.687 10.1542 12.0659 9.60716 11.3413 9.23332ZM8.99959 8.63332C8.70622 8.63332 8.41943 8.54633 8.1755 8.38334C7.93156 8.22035 7.74144 7.98868 7.62917 7.71764C7.5169 7.44659 7.48753 7.14834 7.54476 6.86061C7.602 6.57287 7.74327 6.30856 7.95072 6.10112C8.15817 5.89367 8.42247 5.75239 8.71021 5.69516C8.99795 5.63792 9.2962 5.6673 9.56724 5.77957C9.83828 5.89184 10.0699 6.08196 10.2329 6.32589C10.3959 6.56983 10.4829 6.85661 10.4829 7.14999C10.4829 7.54339 10.3266 7.92069 10.0485 8.19887C9.77029 8.47704 9.393 8.63332 8.99959 8.63332ZM14.8329 0.666656H3.16626C2.50322 0.666656 1.86733 0.930049 1.39849 1.39889C0.929652 1.86773 0.66626 2.50362 0.66626 3.16666V14.8333C0.66626 15.4964 0.929652 16.1322 1.39849 16.6011C1.86733 17.0699 2.50322 17.3333 3.16626 17.3333H14.8329C15.496 17.3333 16.1319 17.0699 16.6007 16.6011C17.0695 16.1322 17.3329 15.4964 17.3329 14.8333V3.16666C17.3329 2.50362 17.0695 1.86773 16.6007 1.39889C16.1319 0.930049 15.496 0.666656 14.8329 0.666656ZM15.6663 14.8333C15.6663 15.0543 15.5785 15.2663 15.4222 15.4226C15.2659 15.5789 15.0539 15.6667 14.8329 15.6667H3.16626C2.94525 15.6667 2.73328 15.5789 2.577 15.4226C2.42072 15.2663 2.33293 15.0543 2.33293 14.8333V3.16666C2.33293 2.94564 2.42072 2.73368 2.577 2.5774C2.73328 2.42112 2.94525 2.33332 3.16626 2.33332H14.8329C15.0539 2.33332 15.2659 2.42112 15.4222 2.5774C15.5785 2.73368 15.6663 2.94564 15.6663 3.16666V14.8333Z'
                          fill='#382CDD'
                        />
                      </svg>
                    </span>
                    <h3 className='text-sm text-gray-600'>Total Estaciones</h3>
                    {/* <span className='inline-block ml-auto px-2 py-1 text-xs text-gray-500 bg-gray-50 rounded-full'>
                      30 Days
                    </span> */}
                  </div>
                  <h2 className='mb-2 text-3xl font-bold'>{statsHome.totalStations}</h2>
                  <span className='text-xs text-red-500'>
                    <span className='inline-block mr-2'>
                      <svg
                        width={18}
                        height={10}
                        viewBox='0 0 18 10'
                        fill='none'
                        xmlns='http://www.w3.org/2000/svg'
                      >
                        <path
                          d='M16.5 4.16667C16.3906 4.16661 16.2822 4.18812 16.181 4.22998C16.0799 4.27183 15.988 4.33322 15.9106 4.41061C15.8332 4.488 15.7719 4.57989 15.73 4.68103C15.6881 4.78216 15.6666 4.89055 15.6667 5V7.15495L10.4225 1.91084C10.3452 1.83344 10.2533 1.77204 10.1522 1.73015C10.0511 1.68825 9.94277 1.66669 9.83333 1.66669C9.7239 1.66669 9.61554 1.68825 9.51445 1.73015C9.41335 1.77204 9.3215 1.83344 9.24414 1.91084L6.50002 4.65495L2.08919 0.244171C1.93245 0.0902454 1.72127 0.00444584 1.50159 0.00544068C1.28191 0.00643553 1.07151 0.094144 0.91617 0.249483C0.760831 0.404822 0.673123 0.61522 0.672128 0.8349C0.671133 1.05458 0.756932 1.26576 0.910858 1.4225L5.91086 6.4225C5.98822 6.4999 6.08007 6.5613 6.18116 6.60319C6.28226 6.64508 6.39062 6.66665 6.50005 6.66665C6.60948 6.66665 6.71784 6.64508 6.81893 6.60319C6.92003 6.5613 7.01188 6.4999 7.08924 6.4225L9.83336 3.67839L14.4883 8.33334H12.3334C12.1123 8.33334 11.9004 8.42113 11.7441 8.57741C11.5878 8.7337 11.5 8.94566 11.5 9.16667C11.5 9.38768 11.5878 9.59965 11.7441 9.75593C11.9004 9.91221 12.1123 10 12.3334 10H16.5C16.6095 10.0001 16.7179 9.97855 16.819 9.9367C16.9201 9.89484 17.012 9.83346 17.0894 9.75607C17.1668 9.67867 17.2282 9.58678 17.2701 9.48565C17.3119 9.38452 17.3334 9.27612 17.3334 9.16667V5C17.3334 4.89055 17.3119 4.78216 17.2701 4.68103C17.2282 4.57989 17.1668 4.488 17.0894 4.41061C17.012 4.33322 16.9201 4.27183 16.819 4.22998C16.7179 4.18812 16.6095 4.16661 16.5 4.16667Z'
                          fill='#E85444'
                        />
                      </svg>
                    </span>
                    {/* <span>25% less</span> */}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </section>
      </>
  );
}

