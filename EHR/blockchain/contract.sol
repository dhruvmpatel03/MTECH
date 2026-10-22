"""
// SPDX-License-Identifier: UNLICENSED
pragma solidity ^0.8.20;

contract ModelStorage {

    string[] public modelHashes;

    function storeHash(string memory _hash) public {
        modelHashes.push(_hash);
    }

    function getHash(uint index) public view returns (string memory) {
        return modelHashes[index];
    }
}
"""