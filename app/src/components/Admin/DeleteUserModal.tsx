import React, { useEffect, useState } from 'react';
import Card from '../UI/Card';

const DeleteUserModal = props => {
  const [showModal, setShowModal] = useState(false);
  return (
    <Card>
      <button
        className="mr-1 mb-1 rounded bg-pink-500 px-6 py-3 text-sm font-bold uppercase text-white shadow outline-none transition-all duration-150 ease-linear hover:shadow-lg focus:outline-none active:bg-pink-600"
        type="button"
        onClick={() => setShowModal(true)}
      >
        Delete
      </button>
      {showModal ? (
        <>
          <div className="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden outline-none focus:outline-none">
            <div className="relative my-6 mx-auto w-auto max-w-3xl">
              {/*content*/}
              <div className="relative flex w-full flex-col rounded-lg border-0 bg-white shadow-lg outline-none focus:outline-none">
                {/*header*/}
                <div className="flex items-start justify-between rounded-t border-b border-solid border-slate-200 p-5">
                  <h3 className="text-3xl font-semibold">Delete User</h3>
                  <button
                    className="float-right ml-auto border-0 bg-transparent p-1 text-3xl font-semibold leading-none text-black opacity-5 outline-none focus:outline-none"
                    onClick={() => setShowModal(false)}
                  >
                    <span className="block h-6 w-6 bg-transparent text-2xl text-black opacity-5 outline-none focus:outline-none">
                      ×
                    </span>
                  </button>
                </div>
                {/*body*/}
                <div className="relative flex-auto p-6">
                  <p className="my-4 text-lg leading-relaxed text-slate-500">
                    Are you sure you want to delete this user?
                  </p>
                </div>
                {/*footer*/}
                <div className="flex items-center justify-end rounded-b border-t border-solid border-slate-200 p-6">
                  <button
                    className="background-transparent mr-1 mb-1 px-6 py-2 text-sm font-bold uppercase text-red-500 outline-none transition-all duration-150 ease-linear focus:outline-none"
                    type="button"
                    onClick={() => setShowModal(false)}
                  >
                    Cancel
                  </button>
                  <button
                    className="mr-1 mb-1 rounded bg-emerald-500 px-6 py-3 text-sm font-bold uppercase text-white shadow outline-none transition-all duration-150 ease-linear hover:shadow-lg focus:outline-none active:bg-emerald-600"
                    type="button"
                    onClick={() => setShowModal(false)}
                  >
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div className="fixed inset-0 z-40 bg-black opacity-25"></div>
        </>
      ) : null}
    </Card>
  );

  // <Card>
  //   <div
  //     className="fixed top-1/3 bottom-1/3 left-1/2 flex h-1/3 w-1/4 bg-red-300"
  //     onClick={props.onClose}
  //   >
  //     <div className="m-4 bg-white p-10" onClick={e => e.stopPropagation()}>
  //       <div className="text-center">
  //         <h4>DELETE USER</h4>
  //       </div>
  //       <div className="p-10">Are you sure you want to delete User?</div>
  //       <div className="text-center">
  //         <button
  //           className="m-4 rounded-md bg-red-300 p-4"
  //           onClick={props.onClose}
  //           value={'yes'}
  //         >
  //           Yes
  //         </button>
  //         <button
  //           className="m-4 rounded-md bg-red-300 p-4"
  //           onClick={props.handleClick}
  //           value={'no'}
  //         >
  //           No
  //         </button>
  //       </div>
  //     </div>
  //   </div>
  // </Card>
};

export default DeleteUserModal;
