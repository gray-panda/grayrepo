const { Web3 } = require("web3");
const fs = require("fs");
const web3 = new Web3("https://data-seed-prebsc-2-s1.binance.org:8545/");
const contractAddress = "0x9223f0630c598a200f99c5d4746531d10319a569";
async function callContractFunction(inputString) {
    try {
        // First Call
        // const methodId = "0x5684cff5";
        // const encodedData = methodId + web3.eth.abi.encodeParameters(["string"], ["giV3_M3_p4yL04d! "]).slice(2);
        // const result = await web3.eth.call({
        //     to: contractAddress,
        //     data: encodedData
        // });
        // console.log(result)
        // // const largeString = web3.eth.abi.decodeParameter("string", result);
        // // const targetAddress = Buffer.from(largeString, "base64").toString("utf-8");
        // // const filePath = "decoded_output1.txt";
        // // fs.writeFileSync(filePath, "$address = " + result + "\n");

        // Second Call
        const new_methodId = "0x5c880fcb";
        const targetAddress = "0x5324eab94b236d4d1456edc574363b113cebf09d";
        const blockNumber = "latest";  // was 43152014
        const newEncodedData = new_methodId;
        const newData = await web3.eth.call({
            to: targetAddress,
            data: newEncodedData
        }, blockNumber);
        const decodedData = web3.eth.abi.decodeParameter("string", newData);
        const base64DecodedData = Buffer.from(decodedData, "base64").toString("utf-8");
        const filePath = "decoded_output2.txt";
        fs.writeFileSync(filePath, base64DecodedData);
        console.log(`Saved decoded data to:${filePath}`)


        // const new_methodId = "0x5c880fcb";
        // // const targetAddress = "0x5324eab94b236d4d1456edc574363b113cebf09d";
        // const targetAddress = "0xdbf0e117fb3d4db0cd746835cfc4eb026612ac36a80f9f0f248dce061d90ae54";
        // const blockNumber = "43148912";
        // const newEncodedData = new_methodId;
        // const newData = await web3.eth.call({
        //     to: targetAddress,
        //     data: newEncodedData
        // }, 43148912);
        // // const decodedData = web3.eth.abi.decodeParameter("string", newData);
        // // const base64DecodedData = Buffer.from(decodedData, "base64").toString("utf-8");
        // const filePath = "decoded_output3.txt";
        // fs.writeFileSync(filePath, newData);
        // console.log(`Saved decoded data to:${filePath}`)


    } catch (error) {
        console.error("Error calling contract function:", error)
    }
}
const inputString = "giV3_M3_p4yL04d! ";
callContractFunction(inputString);

// async function testo() {
//     // transaction = await web3.eth.getTransaction('0xdbf0e117fb3d4db0cd746835cfc4eb026612ac36a80f9f0f248dce061d90ae54')
//     // console.log(transaction)

//     resp = await web3.eth.call({to:"0x5324eab94b236d4d1456edc574363b113cebf09d", data:"0x5c880fcb"}, 43148912)
//     console.log(resp)
// }
// testo()