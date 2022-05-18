FROM node:alpine
WORKDIR "/app"
COPY ./appnode/package.json ./
RUN npm install
COPY ./appnode/ .
CMD ["npm", "run", "dev"]